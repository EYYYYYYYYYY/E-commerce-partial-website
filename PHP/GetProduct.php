<?php

require_once("dbconn.php");

$selectQuery = "SELECT * FROM prodtbl p JOIN businesstbl b ON p.SellID = b.SellerID";
$selectStmt = $conn -> prepare($selectQuery);
$selectStmt -> execute();

$result = $selectStmt->get_result();
$productList = $result -> fetch_all(MYSQLI_ASSOC);

$products = [];

foreach ($productList as $items){
    $products[]= [
        'id' => $items['ProdID'],
        'seller' => $items['SellID'],
        'sellername' => $items['BusinessName'],
        'name' => $items['ProdName'],
        'type' => $items['ProdType'],
        'description' => $items['ProdDesc'],
        'price' => $items['ProdPrice'],
        'kg' => $items['ProdKG'],
        'avail' =>  $items['ProdAvail'],
        'image' =>  "../".$items['ProdImg'] 
    ];
}

$jsonProducts = json_encode($products, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../../JSON/getproducts.json',$jsonProducts);

$getProducts = file_get_contents('../../JSON/getproducts.json');
$products= json_decode($getProducts, true);

?>