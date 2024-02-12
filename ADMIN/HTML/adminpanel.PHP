<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="../CSS/admincss.css">
</head>

<body>

    <header>
        <h1>Admin</h1>
   
    <ul>
            <li>
                <a href="#" onclick="showDashboard('dashboard')">
                    <i class="ai-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showDashboard('userTab')">
                    <i class="ai-people-multiple"></i>
                    <span>BUYER</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showDashboard('sellerTab')">
                    <i class="ai-people-group"></i>
                    <span>SELLER</span>
                </a>
            </li>
            <li>
                <a href="../HTML/Adminlogin.html">
                    <i class="ai-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        </header>

        <?php
        require_once "../../PHP/dbconn.php";

$query_users = "SELECT COUNT(*) as user_count FROM custbl";
$result_users = mysqli_query($conn, $query_users);

if ($result_users) {
    $row_users = mysqli_fetch_assoc($result_users);
    $userCount = $row_users['user_count'];
} else {
    $userCount = 0;
}
$query_sellers = "SELECT COUNT(*) as seller_count FROM sellertbl";
$result_sellers = mysqli_query($conn, $query_sellers);

if ($result_sellers) {
    $row_sellers = mysqli_fetch_assoc($result_sellers);
    $sellerCount = $row_sellers['seller_count'];
} else {
    $sellerCount = 0; 
}
?>

<section>
    <div id="dashboard" class="dashboard-box">
        <div class="box">
            <h2>Welcome ADMIN!</h2>
        </div>
        <div class="box">
            <h3>Buyers</h3>
            <p>Number of Buyers: <?php echo $userCount; ?></p>
        </div>
        <div class="box">
            <h3>Seller</h3>
            <p>Number of Sellers: <?php echo $sellerCount; ?></p>
        </div>
    </div>
</section>


        <?php


        ?>

           <div id="userTab" class="dashboard-box" style="display: none;">
            <h2><center>Buyers</center></h2>
            <table>
                <tr>
                    <th>Seller ID</th>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                </tr>

                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['seller_id']; ?></td>
                        <td><?php echo $user['first_name']; ?></td>
                        <td><?php echo $user['surname']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['phone_number']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>

        <?php
        $sellers = [
            [
                'seller_id' => 'Alfreds Futterkiste',
                'first_name' => 'Maria',
                'surname' => 'Anders',
                'email' => 'maria@example.com',
                'phone_number' => '123456789',
                'address' => 'Germany',
            ],
            [
                'seller_id' => 'Centro comercial Moctezuma',
                'first_name' => 'Francisco',
                'surname' => 'Chang',
                'email' => 'francisco@example.com',
                'phone_number' => '987654321',
                'address' => 'Mexico',
            ],
        ];

        ?>

<div id="sellerTab" class="dashboard-box">
    <h2><center>Sellers</center></h2>
    <table>
        <th style="color: green;">Verified Accounts</th>
        <tr>
            <th>Seller ID</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
        </tr>

    </table>
    <p>                               </p>
    <br><br><br>
    <table>
        <th style="color: red;">Unverified Accounts</th>
        <tr>
            <th>Seller ID</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Verify</th> 
        </tr>
        <?php foreach ($sellers as $index => $seller): ?>
            <tr id="unverifiedRow_<?php echo $index; ?>">
                <td><?php echo $seller['seller_id']; ?></td>
                <td><?php echo $seller['first_name']; ?></td>
                <td><?php echo $seller['surname']; ?></td>
                <td><?php echo $seller['email']; ?></td>
                <td><?php echo $seller['phone_number']; ?></td>
                <td><?php echo $seller['address']; ?></td>
                <td>
                    <button type="button" class="accept-btn" onclick="acceptRecord(<?php echo $index; ?>)">Accept</button>
                    <button type="button" class="reject-btn" onclick="rejectRecord(<?php echo $index; ?>)">Reject</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<script>
    function acceptRecord(index) {
        var row = document.getElementById('unverifiedRow_' + index);
        var table = document.querySelector('table th[style="color: green;"]').parentNode.parentNode;
        var newRow = table.insertRow(-1);
        for (var i = 0; i < row.cells.length; i++) {
            var newCell = newRow.insertCell(i);
            newCell.innerHTML = row.cells[i].innerHTML;
        }
        row.parentNode.removeChild(row);
    }

    function rejectRecord(index) {
        var row = document.getElementById('unverifiedRow_' + index);
        row.parentNode.removeChild(row);
    }
</script>

        <script>
        function showDashboard(sectionId) {
 
          var dashboardSections = document.querySelectorAll('.dashboard-box');
          dashboardSections.forEach(function(section) {
          section.style.display = 'none';
            });
        var selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
        selectedSection.style.display = 'block';
        }
        }
    </script>
        <script src='https://unpkg.com/akar-icons-fonts'></script>
        <script src="./script.js"></script>
</body>

</html>
