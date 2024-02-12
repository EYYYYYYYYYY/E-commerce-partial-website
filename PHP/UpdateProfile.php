<?php
require_once("dbconn.php");
require_once("session.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST["new_first_name"];
    $newLastName = $_POST["new_last_name"];
    $newAddress = $_POST["new_address"];
    $newEmail = $_POST["new_email"];
    $newPhoneNumber = $_POST["new_phone_number"];

    $sql = "UPDATE custbl SET 
            FirstName='$newFirstName', 
            SurName='$newLastName', 
            Address='$newAddress', 
            Email='$newEmail', 
            PhoneNum='$newPhoneNumber' 
            WHERE CustID=$UserID";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['FirstName'] = $newFirstName;
        $_SESSION['SurName'] = $newLastName;
        $_SESSION['Address'] = $newAddress;
        $_SESSION['Email'] = $newEmail;
        $_SESSION['PhoneNum'] = $newPhoneNumber;

        echo json_encode(["status" => "success", "message" => "Profile updated successfully"]);
    } else {
        echo json_encode(["status" => "fail", "message" => "Error updating profile: " . $conn->error]) ;
    }
}

$conn->close();
header('Content-Type: application/json');
?>