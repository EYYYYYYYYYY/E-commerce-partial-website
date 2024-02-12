<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("dbconn.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = $_POST["user_type"];

    $query = "SELECT * FROM login_info WHERE username=? AND Role=?";
    $stmt = $conn->prepare($query);
    
    $stmt->bind_param("ss", $username,$userType);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0){
        echo json_encode(['status' => 'error', 'message' => 'User is not yet registered']);
     } else {
            // Fetch user information
            $row = $result->fetch_assoc();
            $storedHashedPassword = $row['Password'];
            $role = $row['Role'];
            $UserID = $row['UserID'];
            $storedHashedPassword = $row['Password'];

            // Verify the password
            if (password_verify($password, $storedHashedPassword)) {
                
                // Fetch additional user information from the appropriate table
                $table = ($userType == "BYR") ? "custbl" : "sellertbl";
                $ID = ($role == "BYR") ? 'CustID' : 'SellerID';
                $getInfo = "SELECT * FROM $table WHERE $ID = ?";
                $stmt2 = $conn->prepare($getInfo);
                $stmt2->bind_param("i", $UserID);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $info = $result2->fetch_assoc();

                if($role == "BYR"){
                // Start the session and store user information
                session_start();
                $_SESSION['UserID'] = $UserID;
                $_SESSION['UserType'] = $role;
                $_SESSION['FirstName'] = $info['FirstName'];
                $_SESSION['SurName'] = $info['SurName'];
                $_SESSION['Email'] = $info['Email'];
                $_SESSION['PhoneNum'] = $info['PhoneNum'];
                $_SESSION['Address'] = $info['Address'];
                
                echo json_encode(['status' => 'success', 'message' => 'User is logged in']);
                } elseif ($role == "SLR"){
                    $getBusiness = "SELECT * FROM businesstbl WHERE SellerID = ?";
                    $stmt3 = $conn->prepare($getBusiness);
                    $stmt3->bind_param("i", $UserID);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();
                    if ($result3->num_rows > 0){
                        $info1 = $result3->fetch_assoc();

                        if ($info1['Verification'] === "YES"){
                            session_start();
                            $_SESSION['UserID'] = $UserID;
                            $_SESSION['UserType'] = $role;
                            $_SESSION['FirstName'] = $info['FirstName'];
                            $_SESSION['SurName'] = $info['SurName'];
                            $_SESSION['Email'] = $info['Email'];
                            $_SESSION['PhoneNum'] = $info['PhoneNum'];
                            $_SESSION['Address'] = $info['Address'];
                            
                            echo json_encode(['status' => 'success', 'message' => 'User is logged in']);
                        } else {
                            echo json_encode(['status' => 'ForVerification', 'message' => 'Seller is under verification']);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Seller did not verify']);
                    }
                }else{
                    session_start();
                    $_SESSION['UserID'] = $UserID;
                    $_SESSION['UserType'] = $role;
                    echo json_encode(['status' => 'success', 'message' => 'User is logged in']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Password is incorrect']);
            }
        }
    // Close statements and connection
    $stmt->close();
    $result->close();
    $conn->close();
}


header('Content-Type: application/json');
?>
