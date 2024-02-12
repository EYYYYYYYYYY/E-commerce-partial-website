<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>Organic OASIS</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  <link href="font-awesome.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,500,700&display=swap" rel="stylesheet" />
  <link href="style.css" rel="stylesheet" />
  <link href="responsive.css" rel="stylesheet" />
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
            <div class="menu_btn-style ">
              <button onclick="closeNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div class="overlay-content">
              <a class="" href="../INTERFACES/HTML/landingpage.php"> Home <span class="sr-only">(current)</span></a>
              <a class="" href="about.html"> About</a>
              <a class="active" href="why.html"> Why Us </a>
              <a class="" href="team.html"> Our Team</a>
              <a class="" href="testimonial.html"> Testimonial</a>
              <a class="" href="contact.html"> Contact Us</a>
            </div>
          </div>
          <a class="navbar-brand" href="../index.html">
            <span>
            ORGANIC OASIS
            </span>
          </a>
          <div class="user_option">
            <a href="">
                <span>
                    <i class="fa fa-shopping-cart" aria-hidden="true"> YOUR CART</i> 
                </span>
            </a>
           
        </nav>
      </div>
    </header>

  </div>

  <style>
    /* Add your custom styles for the payment form here */
    .payment-form {
      max-width: 400px;
      margin: 20px auto;
    }

    .stripe-input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .stripe-button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>


<section class="payment-form">
  <h2>Payment Information</h2>
  <form id="payment-form">
    <!-- Additional fields -->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" class="stripe-input" required>

    <label for="shipping-address">Shipping Address:</label>
    <input type="text" id="shipping-address" name="shipping-address" class="stripe-input" required>

    <label for="contact-number">Contact Number:</label>
    <input type="tel" id="contact-number" name="contact-number" class="stripe-input" required>

    <label for="order-date">Order Date:</label>
    <input type="date" id="order-date" name="order-date" class="stripe-input" required>

    
    
    <div id="card-element" class="stripe-input payment-option-fields"></div>


    <div id="paypal-fields" class="payment-option-fields">
      <label for="paypal-email">PayPal Email:</label>
      <input type="email" id="paypal-email" name="paypal-email" class="stripe-input" required>
      <label for="Amount">Amount:</label>
      <input type="amt" id="paypalamt" name="paypalamt" class="stripe-input" required>
    </div>

    <div id="gcash-fields" class="payment-option-fields">
      <label for="gcash-number">GCash Number:</label>
      <input type="text" id="gcash-number" name="gcash-number" class="stripe-input" required>
    </div>

    <div id="cod-fields" class="payment-option-fields">
      <p>No additional fields for Cash on Delivery</p>
    </div>

    <div id="card-errors" role="alert"></div>

    <button class="stripe-button">Submit Payment</button>
  </form>
</section>





<script>
  var stripe = Stripe('your_stripe_public_key');
  var elements = stripe.elements();

  var style = {
    base: {
      fontSize: '16px',
      color: '#32325d',
    }
  };


  var card = elements.create('card', { style: style });

  card.mount('#card-element');

  card.addEventListener('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  function togglePaymentFields() {
    var modeOfPayment = document.getElementById('mode-of-payment').value;


    var paymentOptionFields = document.getElementsByClassName('payment-option-fields');
    for (var i = 0; i < paymentOptionFields.length; i++) {
      paymentOptionFields[i].style.display = 'none';
    }

    var selectedPaymentOptionField = document.getElementById(modeOfPayment + '-fields');
    if (selectedPaymentOptionField) {
      selectedPaymentOptionField.style.display = 'block';
    }
  }

  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function (event) {
    event.preventDefault();

    var additionalData = {
      name: document.getElementById('name').value,
      shippingAddress: document.getElementById('shipping-address').value,
      contactNumber: document.getElementById('contact-number').value,
      orderDate: document.getElementById('order-date').value,
      modeOfPayment: document.getElementById('mode-of-payment').value
    };

    stripe.createToken(card, additionalData).then(function (result) {
      if (result.error) {
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        console.log(result.token);
        console.log(additionalData);
        alert('Payment successful!'); 
      }
    });
  });
</script>

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
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
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
              <a class="" href="index.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
              <a class="" href="about.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> About</a>
              <a class="active" href="why.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Why Us </a>
              <a class="" href="team.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Our Team</a>
              <a class="" href="testimonial.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Testimonial</a>
              <a class="" href="contact.html"> <i class="fa fa-angle-right" aria-hidden="true"></i> Contact Us</a>
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
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

 
  <footer class="footer_section container-fluid">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved.ORGANIC OASIS
    </p>


  <script src="../JS/jquery-3.4.1.min.js"></script>
  <script src="../JS/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="../JS/custom.js"></script>
  <script src="https://js.stripe.com/v3/"></script>

</body>

</html>