<?php
require_once("dbconn.php");

$selectCompleted = "SELECT * FROM invoicetbl i JOIN businesstbl b ON i.SellerID = b.SellerID WHERE CustID = ? AND is_complete = 1";
$selectStmt = $conn -> prepare($selectCompleted);
$selectStmt-> bind_param("i",$UserID);
$selectStmt -> execute();
$result = $selectStmt->get_result();
$invoiceList = $result -> fetch_all(MYSQLI_ASSOC);

$invoicesCompleted = [];

foreach ($invoiceList as $invoice){
    $invoicesCompleted[]= [
        'id' => $invoice['InvoiceID'],
        'customer' => $invoice['CustID'],
        'seller' => $invoice['SellerID'],
        'shop' => $invoice['BusinessName'],
        'date' => $invoice['DatePurchased'],
        'total' => $invoice['TotalP']
    ];
}

$jsonInvoicesC = json_encode($invoicesCompleted, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../JSON/completeInv.json',$jsonInvoicesC);

$selectNot = "SELECT * FROM invoicetbl i JOIN businesstbl b ON i.SellerID = b.SellerID WHERE CustID = ? AND is_complete = 0";
$selectStmt1 = $conn -> prepare($selectNot);
$selectStmt1-> bind_param("i",$UserID);
$selectStmt1 -> execute();
$result1 = $selectStmt1->get_result();
$invoiceList1 = $result1 -> fetch_all(MYSQLI_ASSOC);

$invoicesNotCompleted = [];

foreach ($invoiceList1 as $invoice1){
    $invoicesNotCompleted[]= [
        'id' => $invoice1['InvoiceID'],
        'customer' => $invoice1['CustID'],
        'seller' => $invoice1['SellerID'],
        'shop' => $invoice1['BusinessName'],
        'date' => $invoice1['DatePurchased'],
        'total' => $invoice1['TotalP']
    ];
}

$jsonInvoicesN = json_encode($invoicesNotCompleted, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../JSON/incompleteInv.json',$jsonInvoicesN);

$completeInv = file_get_contents('../JSON/completeInv.json');
$invComplete= json_decode($completeInv, true);

$incompleteInv = file_get_contents('../JSON/incompleteInv.json');
$invInComplete= json_decode($incompleteInv, true);

?>