<?php

$dbHost = "sql12.freemysqlhosting.net"; //Host
$dbUser = "sql12676443"; //User
$dbPassword = "MVwCEffeGC";//Password
$dbName = "sql12676443"; //Database

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>