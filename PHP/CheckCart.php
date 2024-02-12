<?php
require_once("dbconn.php");


$selectQuery = "SELECT * FROM cart c JOIN businesstbl b ON c.SellerID = b.SellerID JOIN prodtbl p ON c.ProductID = p.ProdID WHERE CustID = ?";
$selectStmt = $conn->prepare($selectQuery);
$selectStmt->bind_param("i", $UserID);
$selectStmt->execute();
$selectResult = $selectStmt->get_result();

$cartItems = [];

while ($row = $selectResult->fetch_assoc()) {
    $cartItems[] = [
        'customer' => $row['CustID'],
        'seller' => $row['SellerID'],
        'business' => $row['BusinessName'],
        'id' => $row['ProdID'],
        'name'=> $row['ProdName'],
        'kg' => $row['KG'],
        'price' => $row['Amount'],
        'image' => $row['ProdImg']
    ];
}

$jsonCartItems = json_encode($cartItems, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../JSON/cart.json',$jsonCartItems);


?>