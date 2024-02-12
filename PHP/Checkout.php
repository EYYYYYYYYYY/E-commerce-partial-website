<?php
require('session.php');
require_once('dbconn.php');

$paymentOption = $_POST['payment_option'];
$cartData = file_get_contents('../JSON/cart.json');
$cart = json_decode($cartData, true);


if ($cartData === false) {
    // Handle the error, maybe log it or display an error message
    die("Error: Unable to read cart data.");
}

$cart = json_decode($cartData, true);

// Check if JSON decoding was successful
if ($cart === null) {
    // Handle the JSON decoding error
    die("Error: Unable to decode cart data.");
}

$groupedCart = [];
foreach ($cart as $item) {
    $sellerId = $item['seller'];
    if (!isset($groupedCart[$sellerId])) {
        $groupedCart[$sellerId] = [];
    }
    $groupedCart[$sellerId][] = $item;
}

// Iterate over grouped cart and perform database insertion
foreach ($groupedCart as $sellerId => $items) {
    // Calculate the total price for the seller
    $sellerTotal = 0;
    foreach ($items as $item) {
        $sellerTotal += $item['price'];
    }

    // Prepare and execute the database query for each seller
    $stmt = $conn->prepare("INSERT INTO invoicetbl (CustID, SellerID, TotalP) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $UserID, $sellerId, $sellerTotal);
    $stmt->execute();
    $invoiceID = $stmt->insert_id;
    $stmt->close();

    // Insert payment information
    $insertPaymentSQL = "INSERT INTO ptrackingtbl (MOP) VALUES (?)";
    $stmtPayment = $conn->prepare($insertPaymentSQL);
    $stmtPayment->bind_param("s", $paymentOption);
    $stmtPayment->execute();
    $paymentID = $stmtPayment->insert_id;
    $stmtPayment->close();

    // Insert individual products for the seller
    foreach ($items as $item) {
        $insertProductSQL = "INSERT INTO purchtbl (InvoiceID, ProdID, ProdQty, Prodprice) VALUES (?, ?, ?, ?)";
        $stmtProduct = $conn->prepare($insertProductSQL);
        $stmtProduct->bind_param("iiid", $invoiceID, $item['id'], $item['kg'], $item['price']);
        $stmtProduct->execute();
        $stmtProduct->close();
    }
}



// Return success message
echo json_encode (['status' => 'success', 'message' => 'Payment and product information stored successfully']);
?>
