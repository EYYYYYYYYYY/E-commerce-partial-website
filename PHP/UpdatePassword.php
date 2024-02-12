<?php
require_once("dbconn.php");
require_once("session.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["new_password"];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $sql = "UPDATE login_info SET 
            Password='$hashedPassword'  
            WHERE UserID=$UserID";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Password updated successfully</p>";
    } else {
        echo "<p>Error updating profile</p>" ;
    }
}

$conn->close();
header('Content-Type: application/json');
?>