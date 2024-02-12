<?php
session_start();
require_once("dbconn.php");
// Check if the form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Validate and process form data
    $newProduct = [
        'name' => $_POST['product_name'],
        'type' => $_POST['product_type'],
        'description' => $_POST['product_desc'],
        'price' => floatval($_POST['product_price']),
        'kg' => intval($_POST['product_kg']),
        'avail' => $_POST['product_avail'],
        'image' => uploadImage('product_image'), 
    ];

    // Save the product to the database
    $prodID = saveProductToDatabase($newProduct);
    $newProduct['ProductID'] = $prodID;
    
    $existingProducts = file_get_contents('../JSON/sellerproducts.json');
    $products = json_decode($existingProducts, true);
    $products[] = $newProduct;
    $jsonProducts = json_encode($products, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    file_put_contents('../JSON/sellerproducts.json',$jsonProducts);
}

function uploadImage($inputName) {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES[$inputName]["name"], PATHINFO_EXTENSION );
        $basename   = $filename . "." . $extension;
        
        $source       = $_FILES[$inputName]["tmp_name"];
        $destination  = "../Uploads/{$basename}";
        
        /* move the file */
        move_uploaded_file( $source, $destination );

        // Return the image path
        return $destination;
    }

    // If no image is uploaded, return a default image path
    return 'path/to/default_image.jpg';  
}

function saveProductToDatabase($product) {
    global $conn;

    $UserID = $_SESSION['UserID'];
    $name = mysqli_real_escape_string($conn, $product['name']);
    $type = mysqli_real_escape_string($conn, $product['type']);
    $description = mysqli_real_escape_string($conn, $product['description']);
    $price = $product['price'];
    $kg = $product['kg'];
    $avail = $product['avail'];
    $image = mysqli_real_escape_string($conn, $product['image']);


    $query = "INSERT INTO prodtbl (SellID, ProdType, ProdName, ProdDesc, ProdPrice, ProdKG, ProdAvail, ProdImg) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($query);
    $insertStmt->bind_param("ssssdsss", $UserID, $type, $name, $description, $price, $kg, $avail, $image);
    $insertStmt->execute();
    echo json_encode(['status' => 'success', 'message' => 'Product is added successfully!']);

    return mysqli_insert_id($conn);
    $conn->close();
}
header('Content-Type: application/json');
?>