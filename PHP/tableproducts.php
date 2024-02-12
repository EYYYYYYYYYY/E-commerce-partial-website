<?php
require("dbconn.php");

$ID = ($UserType == "BYR") ? "CustID" : "SellerID";

$selectCompleted = "SELECT * FROM purchtbl pu JOIN  invoicetbl i ON i.InvoiceID = pu.InvoiceID JOIN businesstbl b  ON i.SellerID = b.SellerID JOIN prodtbl p  ON pu.ProdID = p.ProdID WHERE i.$ID = ?";
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
        'product' => $invoice['ProdName'],
        'qty' => $invoice['ProdQty'],
        'price' => $invoice['ProdPrice']*$invoice['ProdQty'],
        'total' => $invoice['TotalP']
    ];
}

$jsonInvoicesC = json_encode($invoicesCompleted, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../JSON/tableproducts.json',$jsonInvoicesC);

$tableprod = file_get_contents('../JSON/tableproducts.json');
$tableProd= json_decode($tableprod, true);
?>