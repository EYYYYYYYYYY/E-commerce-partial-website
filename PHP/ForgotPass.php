<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("../../../../sendmail/PHPMailer/src/Exception.php");
require("../../../../sendmail/PHPMailer/src/PHPMailer.php");
require("../../../../sendmail/PHPMailer/src/SMTP.php");
require_once("dbconn.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$userType = $_POST["userType"];
$email = $_POST["Email"];

$table = ($userType == "BYR") ? "custbl" : "sellertbl";
$ID = ($userType == "BYR") ? 'CustID' : 'SellerID';

$selectQuery = "SELECT * FROM $table WHERE Email = ?";
$selectStmt = $conn->prepare($selectQuery);
$selectStmt->bind_param("s", $email); // "s" for string
$selectStmt->execute();
$selectResult = $selectStmt->get_result();

if ($selectResult->num_rows == 0) {
    echo json_encode(['status' => 'error', 'message' => 'User is not yet registered']);
} else {
    $token = uniqid();
    $insertQuery = "CALL insertForgotPass(?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("sss", $token, $email, $userType); // "ss" for two strings
    $insertStmt->execute();

    $resetLink = 'http://localhost/webdevfinals/ORGANIC%20OASIS/PHP/FPassword.php?token=' . $token;

    $mail = new PHPMailer(true);
    $mail ->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'organicoasis850@gmail.com';
    $mail->Password = 'ofkbkaczgcutjwmv';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 465;

    $mail->setFrom('organicoasis850@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->Subject = "Password Reset Request";
    $mail->Body = "
    Dear User,
    <br><br>
    You have requested a password reset for your account. To proceed with the password reset process, please click the link below:
    <br><br>
    <a href='$resetLink'>Reset Password</a>
    <br><br>
    Please note that this link is valid for 15 minutes, after which it will expire.If you did not request this password reset, you can safely ignore this email.
    <br><br>
    Thank you,<br>
    Organic Oasis Team
    ";


    try {
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Email sent!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Email could not be sent.']);
    }
}

header('Content-Type: application/json');
?>
