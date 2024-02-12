<?php
require("dbconn.php");
$user = $_POST['sellerID'];
$selectUser =  "UPDATE businesstbl SET Verification = 1 WHERE SellerID=?";
$stmt = $conn->prepare($selectUser);
$stmt->bind_param("i", $user);

if($stmt->execute()){
    echo json_encode(["status"=>"success","message"=>"Seller verified!"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Error in verifying seller"]);
}


?>