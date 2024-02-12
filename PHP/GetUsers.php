<?php
        $selectQuery1 = "SELECT * FROM sellertbl";
        $selectStmt1 = $conn -> prepare($selectQuery1);
        $selectStmt1 -> execute();
    
        $result1 = $selectStmt1->get_result();
        $sellerList = $result1 -> fetch_all(MYSQLI_ASSOC);
    
        $sellers = [];
    
        foreach ($sellerList as $seller){
            $sellers[]= [
                'id' => $seller['SellerID'],
                'fname' => $seller['FirstName'],
                'fname' => $seller['FirstName'],
                'fname' => $seller['FirstName'],
                'fname' => $seller['FirstName'],
                'fname' => $seller['FirstName'],
            ];
        }
    
        $jsonProducts = json_encode($products1, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        file_put_contents('../../JSON/getproducts.json',$jsonProducts);
    
        $getProducts = file_get_contents('../../JSON/getproducts.json');
        $products= json_decode($getProducts, true);;
?>