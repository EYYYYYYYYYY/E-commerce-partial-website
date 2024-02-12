<?php

session_start();
$userID = $_SESSION['userID'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prodID = $_POST['product_ID']

    require_once('dbconn.ph');

    $selectQuery = "SELECT FROM prodtbl WHERE ProdID = ?"
    $selectStmt = $conn -> prepare($selectQuery);
    $selectStmt -> bind_param("i",$prodID);
    $selectStmt -> execute();
    $selectResult = $selectStmt -> get_result();

    if ($selectResult->num_rows == 0){
        echo json_encode(['status' => 'fail', 'message' => 'Product does not exist!']);
    } else {
        $deleteQuery = "DELETE FROM prodtbl WHERE ProdID = ?"
        $deleteStmt = $conn -> prepare($deleteQuery);
        $deleteStmt -> bind_param("i",$prodID);
        $deleteStmt -> execute();
        echo json_encode(['status' => 'success', 'message' => 'Product deleted!']);
    }
}

?>