<?php

session_start();
$userID = $_SESSION['userID'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prodID = $_POST['product_ID']
    $prodName = $_POST['product_name']
    $prodType = $_POST['product_Type']
    $prodDescription = $_POST['product_description']
    $prodPrice = $_POST['product_price']
    $prodAvail = $_POST['product_avail']
    $prodKG= $_POST['product_kg']

    require_once('dbconn.php');

    $selectQuery = "SELECT FROM prodtbl WHERE ProdID = ?"
    $selectStmt = $conn -> prepare($selectQuery);
    $selectStmt -> bind_param("i",$prodID);
    $selectStmt -> execute();
    $selectResult = $selectStmt -> get_result();

    if ($selectResult->num_rows == 0){
        echo json_encode(['status' => 'fail', 'message' => 'Product does not exist!']);
    } else {
        $updateQuery = "UPDATE prodtbl SET ";
        $updateParams = [];
        $updateTypes = "";

        if ($prodType !== null) {
            $updateQuery .= "ProdType = ?, ";
            $updateParams[] = $prodType;
            $updateTypes .= "s";
        }

        if ($prodName !== null) {
            $updateQuery .= "ProdName = ?, ";
            $updateParams[] = $prodName;
            $updateTypes .= "s";
        }

        if ($prodDescription !== null) {
            $updateQuery .= "ProdDesc = ?, ";
            $updateParams[] = $prodDescription;
            $updateTypes .= "s";
        }

        if ($prodPrice !== null) {
            $updateQuery .= "ProdPrice = ?, ";
            $updateParams[] = $prodPrice;
            $updateTypes .= "d";
        }

        if ($prodKG !== null) {
            $updateQuery .= "ProdKG = ?, ";
            $updateParams[] = $prodKG;
            $updateTypes .= "d";
        }

        if ($prodAvail !== null) {
            $updateQuery .= "ProdAvail = ?, ";
            $updateParams[] = $prodAvail;
            $updateTypes .= "i";
        }

        // Remove the trailing comma and space
        $updateQuery = rtrim($updateQuery, ", ");

        // Add the WHERE clause
        $updateQuery .= " WHERE ProdID = ?";

        // Bind parameters
        $updateParams[] = $prodID;
        $updateTypes .= "i";

        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param($updateTypes, ...$updateParams);
        $updateStmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Product updated!']);
    }
}

?>