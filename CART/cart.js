document.addEventListener('DOMContentLoaded', function () {
  // Quantity and Remove Buttons
  const quantityButtons = document.querySelectorAll('.quantity-btn');
  const removeButtons = document.querySelectorAll('.remove-btn');

  quantityButtons.forEach(button => {
    button.addEventListener('click', function() {
      const quantityElement = this.parentNode.querySelector('.quantity');
      let quantity = parseInt(quantityElement.textContent);

      if (this.textContent === '+' && quantity < 10) {
        quantity++;
      } else if (this.textContent === '-' && quantity > 1) {
        quantity--;
      }

      quantityElement.textContent = quantity;
    });
  });

  removeButtons.forEach(button => {
    button.addEventListener('click', function() {
      const product = this.closest('.product');
      product.remove();
      updateTotal(); // Add this function to update the total after removing a product
    });
  });

  function updateTotal() {
    const prices = document.querySelectorAll('.price');
    let total = 0;

    prices.forEach(priceElement => {
      const price = parseFloat(priceElement.textContent.replace('$', ''));
      const quantity = parseInt(priceElement.parentNode.querySelector('.quantity').textContent);
      total += price * quantity;
    });

    const totalElement = document.querySelector('.total p');
    totalElement.textContent = `Total: $${total.toFixed(2)}`;
  }

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.querySelector(".checkoutButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function () {
    modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
});
