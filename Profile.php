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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link href="../css/style.css" rel="stylesheet" />
  <link href="../css/responsive.css" rel="stylesheet" />
  <script src="../JS/updateprofile.js"></script>
  <?php require('../PHP/session.php'); ?>
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
          <div id="closeButton" class="menu_btn-style ">
              <button onclick="closeNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div class="overlay-content">
              <a class="active" href="../INTERFACES/HTML/landingpage.php"> Home <span class="sr-only">(current)</span></a>
              <a class="" href="Profile.php"> Profile</a>
              <a class="" href="../History/History.php"> Purchase History</a>
              <a class="" href="../CART/cart.php"> Your Cart</a>
              <a class="" href="../PHP/SessionDestroy.php"> Logout</a>
            </div>
          </div>
          <a class="navbar-brand" href="../INTERFACES/HTML/landingpage.php">
            <span>
              ORGANIC OASIS
            </span>
          </a>
          <div class="user_option">
            <a href="../CART/cart.php">
                <span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"> YOUR CART</i> <!-- Use an appropriate cart icon here -->
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

    <h2>Your Profile</h2>
    
<div class="profile-container">
  <h2>Profile Details</h2>

  <div class="profile-detail">
    <strong>First Name:</strong>
    <p><?php echo $FirstName; ?></p>
  </div>

  <div class="profile-detail">
    <strong>Last Name:</strong>
    <p><?php echo $SurName; ?></p>
  </div>

  <div class="profile-detail">
    <strong>Address:</strong>
    <p><?php echo $Address; ?></p>
  </div>

  <div class="profile-detail">
    <strong>Email:</strong>
    <p><?php echo $Email; ?></p>
  </div>

  <div class="profile-detail">
    <strong>Phone Number:</strong>
    <p><?php echo $PhoneNum; ?></p>
  </div>
</div>


<div class="button-container">
  <button onclick="openModal('editModal')" class="edit-profile-btn">Edit Profile</button>
</div>

<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('viewModal')">&times;</span>
        <h2>Profile Details</h2>
        <p><strong>First Name:</strong> <?php echo $FirstName; ?></p>
        <p><strong>Last Name:</strong> <?php echo $SurName; ?></p>
        <p><strong>Address:</strong> <?php echo $Address; ?></p>
        <p><strong>Email:</strong> <?php echo $Email; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $PhoneNum; ?></p>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h2>Edit Profile</h2>
        <!-- Form for editing profile, similar to the previous edit_profile.php -->
        <form method="post" onsubmit="updateprofile(event)" id="updateprofile">
            <input type="hidden" name="user_id" value="<?php echo $UserID; ?>">
            
            <label for="new_first_name">New First Name:</label>
            <input type="text" name="new_first_name" value="<?php echo $FirstName; ?>" required>
            
            <br>
            
            <label for="new_last_name">New Last Name:</label>
            <input type="text" name="new_last_name" value="<?php echo $SurName; ?>" required>
            
            <br>
            
            <label for="new_address">New Address:</label>
            <textarea name="new_address" rows="4" required><?php echo $Address; ?></textarea>
            
            <br>
            
            <label for="new_email">New Email:</label>
            <input type="email" name="new_email" value="<?php echo $Email; ?>" required>
            
            <br>
            
            <label for="new_phone_number">New Phone Number:</label>
            <input type="tel" name="new_phone_number" value="<?php echo $PhoneNum; ?>" required>
            
            <br>
            
            <input type="submit" value="Update Profile">
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        var modals = document.getElementsByClassName('modal');
        for (var i = 0; i < modals.length; i++) {
            var modal = modals[i];
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>

<section class="info_section layout_padding2">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="info_contact">
          <h5>
            Sta. Mesa Manila PH
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
            Explore our website
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
         Connect with us
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
    function openNav() {
  var myNav = document.getElementById("myNav");
  myNav.style.width = "100%";
  showCloseButton(true); 
 }
function closeNav() {
  var myNav = document.getElementById("myNav");
  myNav.style.width = "0%";
  showCloseButton(false); 
}

function showCloseButton(isVisible) {
  var closeButton = document.getElementById("closeButton");
  var overlay = document.getElementById("myNav");

  if (closeButton && overlay) {
    if (isVisible && overlay.style.width !== "0") {
      closeButton.style.display = "block";
    } else {
      closeButton.style.display = "none";
    }
  } else {
    console.error("Close button or overlay element not found!");
  }
}
  </script> 


 <script src="../../JSjquery-3.4.1.min.js"></script>
  <script src="../../JSbootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="../../JScustom.js"></script>

</body>

</html>