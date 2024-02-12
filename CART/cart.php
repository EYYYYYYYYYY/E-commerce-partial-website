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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <?php require('../PHP/session.php'); ?>
  <?php require('../PHP/CheckCart.php'); ?>
</head>
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
            <div id= "closeButton" class="menu_btn-style ">
              <button onclick="closeNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div class="overlay-content">
              <a class="active" href="../INTERFACES/HTML/landingpage.php"> Home <span class="sr-only">(current)</span></a>
              <a class="" href="../Profile/Profile.php"> Profile</a>
              <a class="" href="../History/History.php"> Purchase History</a>
              <a class="" href="cart.php"> Your Cart</a>
              <a class="" href="../PHP/SessionDestroy.php"> Logout</a>
            </div>
          </div>
          <a class="navbar-brand" href="../INTERFACES/HTMLlandingpage.php">
            <img src="../Asset/logo_transparent.png" alt="Organic Oasis Logo">
            <span>ORGANIC OASIS</span>
          </a>
          <div class="user_option">
            <a href="cart.php">
                <span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"> YOUR CART</i>
                </span>
            </a>
            <form class="form-inline">
                <button class="btn nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        </nav>
      </div>
    </header>
     <div class="cart-container">
     <?php
        $existingProducts = file_get_contents('../JSON/cart.json');
        $products = json_decode($existingProducts, true);

        if ($products == NULL || empty($products)) {
            echo "Empty cart";
        } else {
            // Group cart items by SellerID
            $groupedProducts = [];
            foreach ($products as $product) {
                $sellerID = $product['seller'];
                if (!isset($groupedProducts[$sellerID])) {
                    $groupedProducts[$sellerID] = [];
                }
                $groupedProducts[$sellerID][] = $product;
            }

            // Display cart items grouped by SellerID
            foreach ($groupedProducts as $sellerID => $sellerProducts) {
                echo "<div class='cart-section'>";
                echo "<h2>Seller ID: $sellerID</h2>";
                $sellerTotal = 0; // Total amount for the seller
                foreach ($sellerProducts as $product) {
                    echo '<div class="product">';
                    echo '<img src="' . $product["image"] . '" alt="' . $product['name'] . '">';
                    echo '<div class="product-info">';
                    echo '<h3>' . $product['name'] . '</h3>';
                    echo '</div>';     
                    echo '<p class="quantity"> Quantity:' . $product['kg'] . ' KG</p>'; 
                    echo '<p class="price"> PHP ' . $product['price'] . '</p>';
                    echo '<button class="remove-btn" value="'. $product['id'] .'" onclick="removeProduct(this)">Remove</button>';
                    echo '</div>';
                    // Update seller total
                    $sellerTotal += $product['price'];
                }
                // Display seller total and checkout button
                echo "<div class='total'>";
                echo "<p class='total'>Total: PHP $sellerTotal</p>";
                echo "</div>";
                echo "<button class='checkoutButton' onclick='openModal($sellerID,". json_encode($sellerProducts). ",$sellerTotal)'>Checkout</button>";
                echo "</div>";
            }
        }
      ?>

  </div>

  <!-- The Modal -->
  <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>

    <!-- Display cart items and payment options -->
    <div id="modalProducts">
      <!-- Product details will be displayed here -->
    </div>

    <!-- Payment options -->
    <label for="mode-of-payment">Mode of Payment:</label>
    <select id="mode-of-payment" name="mode-of-payment" class="stripe-input" required onchange="togglePaymentFields()">
      <option value="credit-card">Credit Card</option>
      <option value="paypal">PayPal</option>
      <option value="gcash">GCash</option>
      <option value="cash-on-delivery">Cash on Delivery</option>
    </select>
    <!-- Total amount -->
    <div class="total2">
      <p>Total: <span id="modalTotal"></span></p>
    </div>
    <!-- Checkout button inside the modal -->
    <button class="checkoutButton" onclick="checkout()">Checkout</button>
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
<script>
function togglePaymentFields() {
    var selectedPayment = document.getElementById('mode-of-payment').value;
    return selectedPayment;
}

function openModal(sellerID, sellerProducts, totalAmount) {
    // Show the modal
    var modal = document.getElementById('myModal');
    modal.style.display = 'block';

    // Set seller ID and total amount in the modal
    console.log('Seller ID:', sellerID);
    console.log('Total Amount:', totalAmount);

<<<<<<< Updated upstream
    // AJAX call
    $.ajax({
        type: 'POST',
        url: '../PHP/Checkout.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            // Handle success response
        },
        error: function(xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
=======
    // Display products of the specific shop in the modal
    var modalProducts = modal.querySelector('#modalProducts');
    var modalTotal = modal.querySelector('#modalTotal');
    var productsHTML = '';
    var total = 0;

    // Clear previous product data
    modalProducts.innerHTML = '';

    // Check if sellerProducts is an array
    if (Array.isArray(sellerProducts)) {
        // Iterate over sellerProducts array and create HTML for each product
        sellerProducts.forEach(function(product) {
            productsHTML += '<div class="summary">';
            productsHTML += '<img src="' + product['image'] + '" alt="logo" style="width: 100px;">';
            productsHTML += '<p>' + product['name'] + '</p>';
            productsHTML += '<p>' + product['kg'] + '</p>';
            productsHTML += '<p> PHP ' + product['price'] + '</p>';
            productsHTML += '</div>';
            // Update total
            total += parseFloat(product['price']);
        });
    } else {
        console.error('sellerProducts is not an array:', sellerProducts);
    }

    // Update the total amount displayed in the modal
    modalTotal.textContent = total.toFixed(2);

    // Set the HTML content for modal products
    modalProducts.innerHTML = productsHTML;
>>>>>>> Stashed changes
}
</script>
  <script src="cart.js"></script> 

  <footer class="footer_section container-fluid">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved.Organic Oasis
    </p>
  </footer>
 
  <script>
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

    function removeProduct(button) {
      var productId = button.value;

      // Send an AJAX request to remove the product
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../PHP/RemoveToCart.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
          if (xhr.status == 200) {
              console.log(xhr.responseText);
              location.reload();
          }
      };
      xhr.send('productId=' + productId);
    }
  </script>

</body>

</html>
