<?php
require_once("dbconn.php");
    $selectQuery1 = "SELECT * FROM prodtbl p JOIN businesstbl b ON p.SellID = b.SellerID WHERE ProdType  = ?";
    $selectStmt1 = $conn -> prepare($selectQuery1);
    $selectStmt1 -> bind_param ('s', $_GET['id']);
    $selectStmt1 -> execute();

    $result1 = $selectStmt1->get_result();
    $productList1 = $result1 -> fetch_all(MYSQLI_ASSOC);

    $products1 = [];

    foreach ($productList1 as $items){
        $products1[]= [
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

    $jsonProducts = json_encode($products1, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    file_put_contents('../../JSON/getproducts.json',$jsonProducts);

    $getProducts = file_get_contents('../../JSON/getproducts.json');
    $products= json_decode($getProducts, true);;
?>