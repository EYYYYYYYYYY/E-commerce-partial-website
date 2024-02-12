<?php
require('session.php');
require_once("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $custID = $_SESSION['UserID'];
    $sellerID = $_POST['sellerID'];
    $productID = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $productPrice = $_POST['productPrice'];

    $amount = $productPrice * $quantity;

    // Check if the product already exists in the cart for the customer and seller
    $selectQuery = "SELECT * FROM cart WHERE CustID = ? AND SellerID = ? AND ProductID = ?";
    $selectStmt = $conn->prepare($selectQuery);
    $selectStmt->bind_param("iii", $custID, $sellerID, $productID);
    $selectStmt->execute();
    $selectResult = $selectStmt->get_result();

    if ($selectResult->num_rows > 0) {
        // Product already exists, update the KG
        $updateQuery = "UPDATE cart SET KG = KG + ?, Amount = Amount + ? WHERE CustID = ? AND SellerID = ? AND ProductID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("diidi", $quantity, $amount, $custID, $sellerID, $productID);

        if ($updateStmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Product KG Updated Successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error Updating Product KG']);
        }

        $updateStmt->close();
    } else {
        // Product does not exist, insert a new record
        $insertQuery = "INSERT INTO cart (CustID, ProductID, SellerID, KG, Amount) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("iiidi", $custID, $productID, $sellerID, $quantity, $amount);

        if ($insertStmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Product Added Successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error Adding the Product']);
        }
        $insertStmt->close();
    }

    $selectStmt->close();
    $conn->close();
}
?>