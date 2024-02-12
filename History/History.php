<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Organic Oasis</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,500,700&display=swap" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <link href="../css/responsive.css" rel="stylesheet" />
  <?php require('../PHP/session.php'); ?>
  <?php require('../PHP/tableproducts.php'); ?>
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
    width: 80%;
    display: flex; /* Use flexbox layout */
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
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <div class="custom_menu-btn">
        <button onclick="openNav()">
          <span class="s-1"> </span>
          <span class="s-2"> </span>
          <span class="s-3"> </span>
        </button>
      </div>
      <div id="myNav" class="overlay">
        <div id="closeButton" class="menu_btn-style ">
          <button onclick="closeNav()">
            <span class="s-1"> </span>
            <span class="s-2"> </span>
            <span class="s-3"> </span>
          </button>
        </div>
        <div class="overlay-content">
          <a class="active" href="../INTERFACES/HTML/landingpage.php"> Home <span class="sr-only">(current)</span></a>
          <a class="" href="../Profile/Profile.php"> Profile</a>
          <a class="" href="History.php"> Purchase History</a>
          <a class="" href="../CART/cart.php"> Your Cart</a>
          <a class="" href="../PHP/SessionDestroy.php"> Logout</a>
        </div>
      </div>
      <a class="navbar-brand" href="../INTERFACE/HTML/landingpage.php">
        <span>
        <img src="../Asset/logo_transparent.png" alt="Organic Oasis Logo">
          ORGANIC OASIS
        </span>
      </a>
      <div class="user_option">
        <a href="../CART/cart.php">
            <span>
                <i class="fa fa-shopping-cart" aria-hidden="true"> YOUR CART</i> <!-- Use an appropriate cart icon here -->
            </span>
        </a>
      </div>     
    </nav>
  </div>
</header>

<h1>    Purchase History</h1>

<?php include('../PHP/fetchPurchases.php'); ?>

<table class="payment-table">
    <thead>
        <th style="color: black;">Ongoing Orders</th>
        <tr>
            <th>Invoice ID</th>
            <th>Shop Name</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invInComplete as $incomplete): ?>
            <tr class="record-row" data-id="<?php echo $incomplete['id']; ?>" data-shop="<?php echo $incomplete['shop']; ?>" data-total="<?php echo $incomplete['total']; ?>" data-date="<?php echo $incomplete['date']; ?>">
                <td><?php echo $incomplete['id']; ?></td>
                <td><?php echo $incomplete['shop']; ?></td>
                <td><?php echo $incomplete['total']; ?></td>
                <td><?php echo $incomplete['date']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Invoice Details</h2>
    <table>
      <tr>
        <td><strong>Invoice ID:</strong></td>
        <td><span id="modal-invoice-id"></span></td>
      </tr>
      <tr>
        <td><strong>Shop Name:</strong></td>
        <td><span id="modal-shop-name"></span></td>
      </tr>
      <tr>
        <td><strong>Date:</strong></td>
        <td><span id="modal-date"></span></td>
      </tr>
      <tr>
        <td colspan="2">
          <strong>Products:</strong>
          <ul id="modal-product-list" style="none"></ul> <!-- This is where the product list will be displayed -->
        </td>
      </tr>
      <tr>
        <td><strong>Amount:</strong></td>
        <td><span id="modal-amount"></span></td>
      </tr>
    </table>
  </div>
</div>




<table class="payment-table">
    <thead>
      <th>Completed Orders</th>
        <tr>
            <th>Invoice ID</th>
            <th>Shop Name</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invComplete as $complete): ?>
          <tr class="record-row-completed" data-id="<?php echo $complete['id']; ?>" data-shop="<?php echo $complete['shop']; ?>" data-total="<?php echo $complete['total']; ?>" data-date="<?php echo $complete['date']; ?>">
                <td><?php echo $complete['id']; ?></td>
                <td><?php echo $complete['shop']; ?></td>
                <td><?php echo $complete['total']; ?></td>
                <td><?php echo $complete['date']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="myModalCompleted" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Invoice Details</h2>
    <table>
      <tr>
        <td><strong>Invoice ID:</strong></td>
        <td><span id="modal-invoice-id-completed"></span></td>
      </tr>
      <tr>
        <td><strong>Shop Name:</strong></td>
        <td><span id="modal-shop-name-completed"></span></td>
      </tr>
      <tr>
        <td><strong>Date:</strong></td>
        <td><span id="modal-date-completed"></span></td>
      </tr>
      <tr>
        <td colspan="2">
          <strong>Products:</strong>
          <ul id="modal-product-list-completed" style="none"></ul> <!-- This is where the product list will be displayed -->
        </td>
      </tr>
      <tr>
        <td><strong>Amount:</strong></td>
        <td><span id="modal-amount-completed"></span></td>
      </tr>
    </table>
  </div>
</div>



<section class="info_section layout_padding2">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="info_contact">
          <h5>Sta. Mesa Manila PH</h5>
          <div class="contact_link_box">
            <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i><span>Location</span></a>
            <a href=""><i class="fa fa-phone" aria-hidden="true"></i><span>099999999</span></a>
            <a href=""><i class="fa fa-envelope" aria-hidden="true"></i><span>OrganicOasis@gmail.com</span></a>
          </div>
        </div>
        <div class="info_social">
          <a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://twitter.com/home"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="https://www.linkedin.com/in"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info_link_box">
          <h5>Explore our website</h5>
          <div class="info_links">
            <a class="active" href="../INTEFACES/HTML/landingpage.php"> <i class="fa fa-angle-right" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
            <a class="" href="about.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> About</a>
            <a class="" href="why.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Why Us </a>
            <a class="" href="team.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Our Team</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">  
        <h5>Connect with us</h5>
        <form action="">
          <input type="text" placeholder="Enter Your email" />
          <button type="submit">Send email</button>
        </form>
      </div>
    </div>
  </div>
</section>

<footer class="footer_section container-fluid">
  <p>&copy; <span id="displayYear"></span> All Rights Reserved. Organic Oasis.</p>
</footer>

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
                var shop = this.getAttribute('data-shop');
                var amount = parseFloat(this.getAttribute('data-total'));
                var date = this.getAttribute('data-date');

                // Find the corresponding products in the JSON data
                var products = data.filter(item => item.id === parseInt(id));
                if (products.length > 0) {
                    // Populate the modal elements with invoice details
                    document.getElementById("modal-invoice-id").textContent = id;
                    document.getElementById("modal-shop-name").textContent = shop;
                    document.getElementById("modal-amount").textContent = amount.toFixed(2);
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
                var shopName = this.getAttribute('data-shop');
                var amount = parseFloat(this.getAttribute('data-total'));
                var date = this.getAttribute('data-date');

                // Find the corresponding products in the JSON data
                var products = data.filter(item => item.id === parseInt(invoiceId)); // Fix variable name here
                if (products.length > 0) {
                    document.getElementById("modal-invoice-id-completed").textContent = invoiceId; // Fix variable name here
                    document.getElementById("modal-shop-name-completed").textContent = shopName;
                    document.getElementById("modal-amount-completed").textContent = amount.toFixed(2);
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


function openNav() {
  var myNav = document.getElementById("myNav");
  myNav.style.width = "100%";
  showCloseButton(true); // Show the close button when opening the navigation
}

function closeNav() {
  var myNav = document.getElementById("myNav");
  myNav.style.width = "0%";
  showCloseButton(false); // Hide the close button when closing the navigation
}
function showCloseButton(isVisible) {
    var closeButton = document.getElementById("closeButton");
    var overlay = document.getElementById("myNav");

    if (closeButton && overlay) {
      if (isVisible && overlay.style.width !== "0%") {
        closeButton.style.display = "block";
      } else {
        closeButton.style.display = "none";
      }
    } else {
      console.error("Close button or overlay element not found!");
    }
  }
  </script>


<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>

