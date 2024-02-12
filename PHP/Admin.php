<!-- admin_login.php (admin login logic) -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminUsername = $_POST["username"];
    $adminPassword = $_POST["password"];

    // Replace these credentials and database details with your own
    $dbHost = "127.0.0.1";
    $dbUser = "root";
    $dbPassword = "Cabrera";
    $dbName = "DB1";

    // Create a connection
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate the admin credentials (this is a basic example, replace it with your validation logic)
    $query = "SELECT * FROM admins WHERE username='$adminUsername' AND password='$adminPassword'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        echo "Admin Login Successful!";
    } else {
        echo "Invalid username or password for admin.";
    }
    // Close the connection
    $conn->close();
}
?>
