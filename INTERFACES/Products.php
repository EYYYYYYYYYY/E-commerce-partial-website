<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/SELLPanel.css">
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <script src="../JS/script.js" defer></script>
    <title>Seller Panel</title>
    <?php require('../PHP/session.php'); ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
</head>
<body>

<header>
<h1 class="hover-color">SELLER PANEL</h1>
   
    <ul>
            <li>
                <a href="SELLERPANEL.PHP" >
                    <i class="ai-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./Products.php">
                <i class="ai-shopping-bag"></i>
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

    <div class="admin-gallery">
        <?php
            require_once("../PHP/SellerProduct.php");
            $existingProducts = file_get_contents('../JSON/sellerproducts.json');
            $products = json_decode($existingProducts, true);

            if ($products == NULL){
                echo "Empty product list";
            }else{
                foreach ($products as $product) {
                    echo '<div class="admin-product">';
                    echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '">';
                    echo '<h3>' . $product['name'] . '</h3>';
                    echo '<p>Price: $' . $product['price'] . '</p>';
                    echo '<p>KG: ' . $product['kg'] . '</p>';
                    echo '<p>Availability: ' . $product['avail'] . '</p>';
                    echo '</div>';
                }
            }
        ?>
    </div>

    <div class="add-product-form">
        <h3>Add or Edit Product</h3>
        <form method="post" onsubmit="addproduct(event)" enctype="multipart/form-data" id="addproduct">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" required>

            <label for="product_type">Product Type:</label>
            <select id="product_type" name="product_type" required>
                <option value="Vegetables">Vegetables</option>
                <option value="Fruits">Fruits</option>
            </select>

            <label for="product_desc">Product Description:</label>
            <input type="text" name="product_desc" required>

            <label for="product_price">Price:</label>
            <input type="number" name="product_price" step="0.01" required>

            <label for="product_kg">KG:</label>
            <input type="number" name="product_kg" required>

            <label for="product_avail">Availability:</label>
            <select id="product_avail" name="product_avail" required>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>

            <label for="product_image">Product Image:</label>
            <input type="file" name="product_image" accept="image/*">

            <input type="submit" value="Add Product">
        </form>
    </div>

    <script src='https://unpkg.com/akar-icons-fonts'></script>
        <script src="./script.js"></script>
</body>
</html>
