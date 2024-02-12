<?php
// Assuming $products is the JSON array containing product data
$existingProducts = file_get_contents('../JSON/cart.json');
$products = json_decode($existingProducts, true);
// Get the product ID from the AJAX request
$productId = $_POST['productId'];

// Loop through the products and remove the one with the matching ID
foreach ($products as $key => $product) {
    if ($product['id'] == $productId) {
        unset($products[$key]); // Remove the product from the array
        break; // Exit the loop after removing the product
    }
}

// Encode the updated products array back to JSON
$jsonProducts = json_encode($products, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../JSON/cart.json',$jsonProducts);

// Save the updated JSON data back to the file or database as needed

// Return a response indicating success or failure
echo json_encode(['status' => 'success', 'message' => 'Product removed successfully']);
?>