<?php
require("dbconn.php");
$user = $_POST['sellerID'];
$deleteLogin =  "DELETE FROM login_info WHERE UserID=?";
$stmt = $conn->prepare($deleteLogin);
$stmt->bind_param("i", $user);
$stmt->execute();

$deleteSeller =  "DELETE FROM sellertbl WHERE SellerID=?";
$stmt1 = $conn->prepare($deleteSeller);
$stmt1->bind_param("i", $user);
$stmt1->execute();

$deleteBusiness =  "DELETE FROM businesstbl WHERE SellerID=?";
$stmt2 = $conn->prepare($deleteBusiness);
$stmt2->bind_param("i", $user);
$stmt2->execute();

echo json_encode(["status"=>"success","message"=>"Rejected!"]);
?>