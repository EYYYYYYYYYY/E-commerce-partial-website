<?php
function getProductsByCategory($product_Type) {
  
    $products = array();
    if ($category === "fruit") {
        $products = array(
            array("id" => 1, "name" => "Apple"),
            array("id" => 2, "name" => "Banana"),
            array("id" => 3, "name" => "Orange")
        );
    } elseif ($category === "vegetables") {
        $products = array(
            array("id" => 4, "name" => "Carrot"),
            array("id" => 5, "name" => "Broccoli"),
            array("id" => 6, "name" => "Tomato")
        );
    }
    return $products;
}

// Check if the category parameter is set in the request
if (isset($_GET['product_Type'])) {
    $product_Type = $_GET['product_Type'];
    $product_Type = getProductsByCategory($product_Type);
    echo json_encode($products); // Return the products as JSON
} else {
    echo "Category parameter is missing";
}
?>
