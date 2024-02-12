<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Organic Oasis</title>
  <link rel="icon" type="image/x-icon" href="../../Asset/favicon.png">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
  <link href="../../css/font-awesome.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,500,700&display=swap" rel="stylesheet" />
  <link href="../../css/style.css" rel="stylesheet" />
  <link href="../../css/responsive.css" rel="stylesheet" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <?php require('../../PHP/session.php'); ?>
  <?php require('../../PHP/AllProduct.php'); ?>
</head>
<style>
   #searchForm {
    margin: 20px;
  }
  #results {
    margin: 1px;
    position: fixed; 
    top: 70px; 
    right: 60px; 
    padding: 30px;
}

</style>
<body>
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
                <div class="menu_btn-style ">
                    <button onclick="closeNav()">
                        <span class="s-1"> </span>
                        <span class="s-2"> </span>
                        <span class="s-3"> </span>
                    </button>
                </div>
                <div class="overlay-content">
                    <a class="active" href="landingpage.php"> Home <span class="sr-only">(current)</span></a>
                    <a class="" href="../../Profile/Profile.php"> Profile</a>
                    <a class="" href="../../History/History.php"> Purchase History</a>
                    <a class="" href="../../CART/cart.php"> Your Cart</a>
                    <a class="" href="../../PHP/SessionDestroy.php"> Logout</a>
                </div>
            </div>
            <a class="navbar-brand" href="landingpage.php">
                <img src="../../Asset/logo_transparent.png" alt="Organic Oasis Logo">
                <span>ORGANIC OASIS</span>
            </a>
          
            <div class="user_option">
                <a href="../../CART/cart.php">
                    <span>
                        <i class="fa fa-shopping-cart" aria-hidden="true"> YOUR CART</i>
                    </span>
                </a>
                <form id="searchForm">
    <input type="text" id="searchInput" placeholder="Enter your search query">
    <button type="submit">Search</button>
  </form>
  <div id="results"></div>

  <script>
     var data = [];

fetch('../../JSON/allproducts.json')
  .then(response => response.json())
  .then(jsonData => {
    data = jsonData;
    console.log(data); 
  })
  .catch(error => {
        console.error('Error loading JSON file:', error);
      });

    document.getElementById('searchForm').addEventListener('submit', function(event) {
      event.preventDefault();
      var query = document.getElementById('searchInput').value;
      var results = performSearch(query);
      displayResults(results);
    });

    function performSearch(query) {
      var matchingResults = [];
      data.forEach(item => {
        if (item.name.toLowerCase().includes(query.toLowerCase())) {
          matchingResults.push(item);
        }
      });
      return matchingResults;
    }

    function displayResults(results) {
      var resultsDiv = document.getElementById('results');
      resultsDiv.innerHTML = '';
      if (results.length === 0) {
        resultsDiv.textContent = 'No results found.';
      } else {
        var ul = document.createElement('ul');
        results.forEach(function(result) {
          var li = document.createElement('li');
          // Create a link to the product detail page
          var link = document.createElement('a');
          link.textContent = result.name; // Displaying name from JSON data
          link.href = 'proddetail.php?id=' + result.id; // Assuming product_detail.html is the detail page
          li.appendChild(link);
          ul.appendChild(li);
        });
        resultsDiv.appendChild(ul);
      }
    }
</script>
        </nav>
    </div>

    <section class="service_section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <button class="sorting-btn" data-category="Fruits" onclick="displaySort('Fruits')">
          <div class="box">
            <div class="img-box">
              <img src="../../images/20.png" alt="Fruit" />
              <div class="detail-box">
              <h4>Fruit</h4>
            </div>
          </div>
        </button>
      </div>
      <div class="col-lg-3 col-md-6">
        <button class="sorting-btn" data-category="Vegetables" onclick="displaySort('Vegetables')">
          <div class="box">
            <div class="img-box">
              <img src="../../images/30.png" alt="Vegetables" />
              <div class="detail-box">
              <h4>Vegetable</h4>
            </div>
          </div>
        </button>
      </div>
    </div>
  </div>
</section>


  <section class="product_section">
  <?php
  include('../../PHP/GetProduct.php');
  foreach ($products as $product){
  ?>
    <div class="product_box">
        <input type="hidden" id="sellerID" name="sellerID" value="<?php echo $product['seller']; ?>">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
        <h4><?php echo $product['name']; ?></h4>
        <p>Description: <?php echo $product['description']; ?></p>
        <p>Shop: <?php echo $product['sellername']; ?></p>
        <span>PHP <?php echo $product['price']; ?></span>
        <label for="quantity_<?php echo $product['id']; ?>">KG:</label>
        <div class="quantity-input">
            <button onclick="decrementQuantity('<?php echo $product['id']; ?>')">-</button>
            <input type="number" id="quantity_<?php echo $product['id']; ?>" name="quantity_<?php echo $product['id']; ?>" value="1" min="1">
            <button onclick="incrementQuantity('<?php echo $product['id']; ?>')">+</button>
        </div>
        <button onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo $product['name']; ?>', '<?php echo $product['price']; ?>', '<?php echo $product['image']; ?>', '<?php echo $product['seller']; ?>')">Add to Cart</button>
    </div>
  <?php
  }
  ?>
</section>


  <section class="why_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Why Choose Organic Oasis
        </h2>
        <p>
          "Harvested with Care, Savored with Zest: Fresh Pickly Delights at Their Peak!"
        </p>
      </div>
      <div class="why_container">
        <div class="box">
          <div class="img-box">
            <img src="../../images/why1.png" alt="" />
          </div>
          <div class="detail-box">
            <h5>
             Farm to market
            </h5>
            <a href="">
              <span>
                Read More
              </span>
              <hr />
            </a>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="../../images/why2.png" alt="" />
          </div>
          <div class="detail-box">
            <h5>
              Best For our Customer
            </h5>
            <a href="">
              <span>
                Read More
              </span>
              <hr />
            </a>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="../../images/why3.png" alt="" />
          </div>
          <div class="detail-box">
            <h5>
              Safe and Sealed delivery
            </h5>
            <a href="">
              <span>
                Read More
              </span>
              <hr />
            </a>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="../../images/why4.png" alt="" />
          </div>
          <div class="detail-box">
            <h5>
              Peoples choices
            </h5>
            <a href="">
              <span>
                Read More
              </span>
              <hr />
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="info_contact">
            <h5>
              Address
            </h5>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  099999999
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                   OrganicOasis@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="https://www.facebook.com/">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="https://twitter.com/home">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="https://www.linkedin.com/in">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="https://www.instagram.com/">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info_link_box">
            <h5>
              Navigation
            </h5>
            <div class="info_links">
              <a class="active" href="index.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
              <a class="" href="about.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> About</a>
              <a class="" href="why.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Why Us </a>
              <a class="" href="team.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Our Team</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <h5>
            Newsletter
          </h5>
          <form action="">
            <input type="text" placeholder="Enter Your email" />
            <button type="submit">
              Send email
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer_section container-fluid">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved.Organic Oasis
    </p>
  </footer>

  <script>
    function toggleSearch() {
      var searchBar = document.getElementById("searchBar");
      searchBar.style.display = searchBar.style.display === "none" ? "block" : "none";
    }
  </script>
  <script>
function incrementQuantity(productId) {
    var quantityInput = document.getElementById('quantity_' + productId);
    quantityInput.stepUp();
}

function decrementQuantity(productId) {
    var quantityInput = document.getElementById('quantity_' + productId);
    quantityInput.stepDown();
}

function addToCart(productId, productName, productPrice, productImg, productSell) {
    // Retrieve the quantity input field associated with the product ID
    var quantityInput = document.getElementById('quantity_' + productId);
    var quantity = quantityInput.value; // Get the quantity value

    // Create a FormData object to send data to the server
    var formData = new FormData();
    formData.append('productId', productId);
    formData.append('productName', productName);
    formData.append('productPrice', productPrice);
    formData.append('quantity', quantity);
    formData.append('image', productImg);
    formData.append('sellerID', productSell);

    $.ajax({
        type: 'POST',
        url: '../../PHP/AddToCart.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }
            if (data.status === 'success') {
                alert(data.message)
            }else{
                alert(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}

function displaySort(ProdType) {
    window.location.href = 'sortingpage.php?id=' + ProdType;
}
</script>


  <script src="../../JS/jquery-3.4.1.min.js"></script>
  <script src="../../JS/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="../../JS/custom.js"></script>

</body>
</html>
