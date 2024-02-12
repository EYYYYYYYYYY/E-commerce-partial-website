<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" type="text/css" href="gallery.css">
    <title>Welcome to Organic Oasis!</title>
</head>

<body>
    <header></header>

    <button type="button" class="category">Vegetables</button>
    <button type="button" class="category">Fruits</button>

    <div class="grid-container">
        <?php
            $existingProducts = file_get_contents('../ORGANIC OASIS/JSON/products.json');
            $products = json_decode($existingProducts, true);
    
            if ($products == NULL){
                echo "Empty product list";
            }else{
                foreach ($products as $item) {
                    echo '<div class="gallery">';
                    echo '<a target="_blank" href="' . $item["image"] . '">';
                    echo '<img src="' . $item["image"] . '" alt="' . $item["description"] . '">';
                    echo '</a>';
                    echo '<div class="desc">' . $item["description"] . '</div>';
                    echo '<p class="availability">' . $item["quantity"] . '</p>';
                    echo '<button type="button" class="cartbtn">Add to Cart</button>';
                    echo '</div>';
                }
            }
        ?>
    </div>

    <footer> All rights reserved.</footer>
</body>
</html>
