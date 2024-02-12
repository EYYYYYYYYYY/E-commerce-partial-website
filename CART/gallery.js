let cartItems = [];

function addToCart(name, price) {
    const item = { name, price };
    cartItems.push(item);
    updateCart();
}

function updateCart() {
    const cartItemsList = document.getElementById('cart-items');
    cartItemsList.innerHTML = '';

    cartItems.forEach(item => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `${item.name} - $${item.price.toFixed(2)}`;
        cartItemsList.appendChild(listItem);
    });
}
