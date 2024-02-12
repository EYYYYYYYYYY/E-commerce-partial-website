<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/SELLPanel.css">
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <?php require('../PHP/session.php'); ?>
    <?php include('../PHP/fetchSales.php'); ?>
    <?php require('../PHP/tableproducts.php'); ?>
    <title>Seller Panel</title>
    <style>
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    column-count:3;
    display:flex;
    }

    .modal-content table {
    margin-right: 5px; /* Add some space between the tables */
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>
<body>

<header>
<h1 class="hover-color">SELLER PANEL</h1>
   
    <ul>
            <li>
                <a href="SELLERPANEL.PHP">
                    <i class="ai-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./Products.php">
                <i class="ai-radish"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="../PHP/SessionDestroy.php">
                <i class="ai-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        </header>
        <section>
           <div id="dashboard" class="dashboard-box">
                <div class="box">
                    <h2>HELLO <?php echo $_SESSION['FirstName'] ?>!</h2>
                </div>
                <div class="box">
                    <h3>WEEKLY REPORTS</h3>
                    <p>Sales per Week: PHP <?php echo $currentWeekSales ?></p>
                </div>
                <div class="box">
                    <h3>MONTHLY REPORTS</h3>
                    <p>Sales per Month: PHP <?php echo $currentMonthSales ?></p>
                </div>
            </div>

    <div id="custbls">
    <div id="ongoingtbl">
        <table class="payment-table">
            <thead>
                <tr>
                    <th colspan="5" style="color: black; background-color:#fff;">Ongoing Orders</th>
                </tr>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
            foreach ($invInComplete as $order) {
                    echo '<tr class="record-row" data-id="'. $order['id'] .'" data-customer="'. $order['customer']. '" data-total="'.  $order['total']. '" data-date="'. $order['date'] .'" style = "cursor:pointer;">';
                    echo "<td>" . $order['id'] . "</td>";
                    echo "<td>" . $order['customer'] . "</td>";
                    echo "<td>" . $order['total'] . "</td>";
                    echo "<td>" . $order['date'] . "</td>";
                    echo "<td>" . $order['status'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2 style = "margin:15%;">Invoice Details</h2>
    <table>
      <tr>
        <td><strong>Invoice ID:</strong></td>
        <td><span id="modal-invoice-id"></span></td>
      </tr>
      <tr>
        <td><strong>Customer Name:</strong></td>
        <td><span id="modal-customer-name"></span></td>
      </tr>
      <tr>
        <td><strong>Date:</strong></td>
        <td><span id="modal-date"></span></td>
      </tr>
      <tr>
        <td colspan="2">
          <strong>Products:</strong>
          <ul id="modal-product-list"></ul> <!-- This is where the product list will be displayed -->
        </td>
      </tr>
      <tr>
        <td><strong>Amount:</strong></td>
        <td><span id="modal-amount"></span></td>
      </tr>
    </table>
  </div>
</div>


    <div id="completedtbl">
        <table class="payment-table">
            <thead>
                <tr>
                    <th colspan="5" style="color: black; background-color:#4FFFB0;">Completed Orders</th>
                </tr>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have an array of completed orders data named $completedOrders
                foreach ($invComplete as $order) {
                    echo '<tr class="record-row" data-id="'. $order['id'] .'" data-customer="'. $order['customer']. '" data-total="'.  $order['total']. '" data-date="'. $order['date'] .'" style = "cursor:pointer;">';
                    echo "<td>" . $order['id'] . "</td>";
                    echo "<td>" . $order['customer'] . "</td>";
                    echo "<td>" . $order['total'] . "</td>";
                    echo "<td>" . $order['date'] . "</td>";
                    echo "<td>" . $order['status'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="myModalCompleted" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2 style = "margin:15%;">Invoice Details</h2>
    <table>
      <tr>
        <td><strong>Invoice ID:</strong></td>
        <td><span id="modal-invoice-id-completed"></span></td>
      </tr>
      <tr>
        <td><strong>Shop Name:</strong></td>
        <td><span id="modal-customer-name-completed"></span></td>
      </tr>
      <tr>
        <td><strong>Date:</strong></td>
        <td><span id="modal-date-completed"></span></td>
      </tr>
      <tr>
        <td colspan="2">
          <strong>Products:</strong>
          <ul id="modal-product-list-completed" ></ul> <!-- This is where the product list will be displayed -->
        </td>
      </tr>
      <tr>
        <td><strong>Amount: PHP</strong></td>
        <td><span id="modal-amount-completed"></span></td>
      </tr>
    </table>
  </div>
</div>



        </section>
        <script>
                var modal = document.getElementById("myModal");
                var modalCompleted = document.getElementById("myModalCompleted");
                var span = document.getElementsByClassName("close");
                var url = '../JSON/tableproducts.json';

                // Fetch the JSON data from the URL
                fetch(url)
                    .then(response => {
                        // Check if response is successful
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        // Parse the JSON data
                        return response.json();
                    })
                    .then(data => {
                        // Process the JSON data
                        // Iterate over each record-row element
                        var rows = document.querySelectorAll(".record-row");
                        rows.forEach(function(row) {
                            row.addEventListener('click', function() {
                                var id = this.getAttribute('data-id');
                                var shop = this.getAttribute('data-customer');
                                var amount = parseFloat(this.getAttribute('data-total'));
                                var date = this.getAttribute('data-date');

                                // Find the corresponding products in the JSON data
                                var products = data.filter(item => item.id === parseInt(id));
                                if (products.length > 0) {
                                    // Populate the modal elements with invoice details
                                    document.getElementById("modal-invoice-id").textContent = id;
                                    document.getElementById("modal-customer-name").textContent = shop;
                                    document.getElementById("modal-amount").textContent = 'PHP ' + amount.toFixed(2);
                                    document.getElementById("modal-date").textContent = date;

                                    // Clear previous product list
                                    var productList = document.getElementById("modal-product-list");
                                    productList.innerHTML = '';

                                    // Populate the modal with products and their amounts
                                    products.forEach(function(product) {
                                        var productItem = document.createElement('li');
                                        productItem.textContent = product.product +' | KG: ' + product.qty +' - PHP ' + product.price;
                                        productList.appendChild(productItem);
                                    });

                                    // Display the modal
                                    modal.style.display = "block";
                                } else {
                                    console.error("Products not found for the invoice ID:", id);
                                }
                            });
                        });
                    })
                    .catch(error => {
                        // Handle any errors
                        console.error('Error fetching or parsing data:', error);
                    });
                
                // Fetch the JSON data from the URL
                fetch(url)
                    .then(response => {
                        // Check if response is successful
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        // Parse the JSON data
                        return response.json();
                    })
                    .then(data => {
                        // Process the JSON data
                        // Iterate over each record-row element
                        var rowsCompleted = document.querySelectorAll(".record-row-completed");
                        rowsCompleted.forEach(function(row) {
                            row.addEventListener('click', function() {
                                var invoiceId = this.getAttribute('data-id');
                                var shopName = this.getAttribute('data-customer');
                                var amount = parseFloat(this.getAttribute('data-total'));
                                var date = this.getAttribute('data-date');

                                // Find the corresponding products in the JSON data
                                var products = data.filter(item => item.id === parseInt(invoiceId)); // Fix variable name here
                                if (products.length > 0) {
                                    document.getElementById("modal-invoice-id-completed").textContent = invoiceId; // Fix variable name here
                                    document.getElementById("modal-customer-name-completed").textContent = shopName;
                                    document.getElementById("modal-amount-completed").textContent = 'PHP ' + amount.toFixed(2);
                                    document.getElementById("modal-date-completed").textContent = date;

                                    // Clear previous product list
                                    var productList = document.getElementById("modal-product-list-completed");
                                    productList.innerHTML = '';

                                    // Populate the modal with products and their amounts
                                    products.forEach(function(product) {
                                        var productItem = document.createElement('li');
                                        productItem.textContent = product.product + ' | KG: ' + product.qty + ' - PHP ' + product.price;
                                        productList.appendChild(productItem);
                                    });

                                    // Display the modal
                                    modalCompleted.style.display = "block";
                                } else {
                                    console.error("Products not found for the invoice ID:", invoiceId);
                                }
                            });
                        });
                    })
                    .catch(error => {
                        // Handle any errors
                        console.error('Error fetching or parsing data:', error);
                    });

                // Event listener for closing modals
                for (var i = 0; i < span.length; i++) {
                    span[i].onclick = function() {
                    modal.style.display = "none";
                    modalCompleted.style.display = "none";
                    }
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                    modal.style.display = "none";
                    }
                    if (event.target == modalCompleted) {
                    modalCompleted.style.display = "none";
                    }
                }
        </script>

        <script src='https://unpkg.com/akar-icons-fonts'></script>
        <script src="./script.js"></script>
</body>
</html>
