<?php
require_once("dbconn.php");

// Function to handle password update
function updatePassword($conn, $table, $ID, $Email,$token) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if ($newPassword !== $confirmPassword) {
            return "<p>Passwords do not match</p>";
        }

        $query1 = "SELECT * FROM $table WHERE Email = ?";
        $stmt1 = $conn->prepare($query1);
        $stmt1->bind_param("s", $Email);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $value1 = $result1->fetch_assoc();
        $UserID = $value1[$ID];

        $sql = "UPDATE login_info SET Password=? WHERE UserID=?";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("si", $hashedPassword, $UserID);
        if ($stmt2->execute()) {
            // Password updated successfully
            echo "<p>Password updated successfully</p>";
            $sql1 = "UPDATE forgotpass SET is_valid = 0 WHERE token=?";
            $stmt3 = $conn->prepare($sql1);
            $stmt3->bind_param("s", $token);
            $stmt3->execute();
            echo "<script>setTimeout(() => { window.close(); }, 2000);</script>";
            return;
        } else {
            return "<p>Error updating password</p>";
        }
    }
    return "<p>Invalid request</p>";
}

// Check if the token is provided in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Query the database to find the token
    $query = "SELECT * FROM forgotpass WHERE token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_assoc();

    $expiration = $value['expiration'];
    $expirationTime = strtotime($expiration) + (24 * 3600);
    $userType = $value['role'];
    $Email = $value['email'];
    $is_valid = $value['is_valid'];
    $table = ($userType == "BYR") ? "custbl" : "sellertbl";
    $ID = ($userType == "BYR") ? 'CustID' : 'SellerID';

    if ($result->num_rows > 0 && time() < $expirationTime && $is_valid === 1) {
        // Handle form submission
        $updateResult = "";
        if (isset($_POST['submit'])) {
            $updateResult = updatePassword($conn, $table, $ID, $Email, $token);
        }

        // HTML content
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
        </head>
        <body>
            <h2>Reset Your Password</h2>
            <?php echo $updateResult; // Display password update result ?>
            <form action="" method="POST">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <div>
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div>
                    <button type="submit" name="submit">Reset Password</button>
                </div>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Invalid or expired token. Please request a new password reset.</p>";
    }
} else {
    echo "Invalid token. Please request a new password reset.";
}
?>
