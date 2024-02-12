<?php
    session_start();
    if (!isset($_SESSION['UserID'])) {
        header("Location: http://localhost/webdevfinals/ORGANIC%20OASIS/index.html"); // Redirect to login page if not logged in
        exit();
    }

    $UserID = $_SESSION['UserID'];
    $UserType = $_SESSION['UserType'];
    $FirstName = $_SESSION['FirstName'];
    $SurName = $_SESSION['SurName'];
    $Email = $_SESSION['Email'];
    $PhoneNum = $_SESSION['PhoneNum'];
    $Address = $_SESSION['Address'];
?>
