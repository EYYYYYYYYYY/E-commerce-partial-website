<?php

require_once("dbconn.php");

$firstname = $_POST['FName'];
$lastname = $_POST['LName'];
$username = $_POST['registrationUsername'];
$password = $_POST['registrationPassword'];
$email = $_POST['registrationEmail'];
$Address = $_POST['Address'];
$Cellphone= $_POST['Cellphone'];
$UserType= $_POST['userType'];
$businessName = $_POST['businessName']; 
$proofOfRegistration = $_FILES['proofOfRegistration']['name']; 

if($UserType === 'SLR'){
    $table = 'sellertbl';
    $ID = 'SellerID';
} else {
    $table = 'custbl';
    $ID = 'CustID';
}

$selectBusiness = "SELECT * FROM $table WHERE BusinessName=?";
$stmtBusiness = $conn->prepare($selectBusiness);
$stmtBusiness->bind_param("s", $businessName);
$stmtBusiness->execute();
$resultBusiness = $stmtBusiness->get_result();

if ($resultBusiness->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Business name already exists!']);
} else {
    $select = "SELECT * FROM $table WHERE email=?";
    $stmt = $conn->prepare($select);

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultEmail = $stmt->get_result();
    if ($resultEmail->num_rows == 0) {

        $selectUser =  "SELECT * FROM login_info WHERE username=? AND Role= ?";
        $stmt = $conn->prepare($selectUser);
        $stmt->bind_param("ss", $username, $UserType);
        $stmt->execute();
        $resultUser = $stmt->get_result();

        if ($resultUser->num_rows == 0) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery1 = "INSERT INTO login_info (Username, Password, Role) VALUES (?, ?, ?)";
            $insertStmt1 = $conn->prepare($insertQuery1);
            $insertStmt1->bind_param("sss", $username, $hashedPassword, $UserType);

            if ($insertStmt1->execute()) {

                $userID = mysqli_insert_id($conn);
                $insertQuery2 = "INSERT INTO $table ($ID,FirstName, Surname, Email, PhoneNum, Address, BusinessName, ProofOfRegistration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $insertStmt2 = $conn->prepare($insertQuery2);
                $insertStmt2->bind_param("isssssss", $userID, $firstname, $lastname, $email, $Cellphone, $Address, $businessName, $proofOfRegistration);

                if ($insertStmt2->execute()){
                    echo json_encode(['status' => 'success', 'message' => 'Registered successfully!']);
                    $insertStmt2->close();
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error in Registering']);
                }

                $insertStmt1->close();    
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error in Registering']);
            }

        }else{
            echo json_encode(['status' => 'error', 'message' => 'User exists!']);
        }

    }else{
        echo json_encode(['status' => 'error', 'message' => 'Email exists!']);
    }
}

$stmt->close();
$conn->close();
header('Content-Type: application/json');

?>
