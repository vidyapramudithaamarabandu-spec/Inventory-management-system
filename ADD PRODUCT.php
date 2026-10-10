<?php
// 1. Database Connection Settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_new_db"; 

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = ""; 

// ----------------------------------------------------
// 2. ADD LOGIC
// ----------------------------------------------------
if (isset($_POST['submit_supplier'])) {
    
    $p_name    = mysqli_real_escape_string($conn, $_POST['PRODUCT_NAME']);
    $p_cat     = mysqli_real_escape_string($conn, $_POST['product_category']);
    $brand     = mysqli_real_escape_string($conn, $_POST['brand']);
    $contact   = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $email     = mysqli_real_escape_string($conn, $_POST['Email']);
    $address   = mysqli_real_escape_string($conn, $_POST['ADDRESS']);
    
    $sql = "INSERT INTO product (product_name, product_category, brand, contact_no, email, address) 
            VALUES ('$p_name', '$p_cat', '$brand', '$contact', '$email', '$address')";
            
    if (mysqli_query($conn, $sql)) {
        $message = "<h3 style='color: green;'>Product '$p_name' added successfully!</h3>";
    } else {
        $message = "<h3 style='color: red;'>Error adding product: " . mysqli_error($conn) . "</h3>";
    }
}

// ----------------------------------------------------
// 3. REMOVE LOGIC
// ----------------------------------------------------
if (isset($_POST['remove_product'])) {
    
    $p_name = mysqli_real_escape_string($conn, $_POST['PRODUCT_NAME']);
    
    // Corrected SQL query
    $sql = "DELETE FROM product WHERE product_name = '$p_name'";
    
    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            $message = "<h3 style='color: green;'>Product '$p_name' removed successfully!</h3>";
        } else {
            $message = "<h3 style='color: orange;'>No product found with the name '$p_name'.</h3>";
        }
    } else {
        $message = "<h3 style='color: red;'>Error removing product: " . mysqli_error($conn) . "</h3>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Action</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f4f7f6;
            text-align: center;
            padding-top: 50px;
        }
        .message-box {
            background-color: white;
            display: inline-block;
            padding: 30px 50px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="message-box">
        <?php 
        // THIS is the part you were missing! This actually prints the message to the screen.
        if ($message != "") {
            echo $message; 
        } else {
            echo "<h3>No action detected. Please submit the form.</h3>";
        }
        ?>
        
        <a href="ADD PRODUCT.html" class="btn">Go Back to Form</a>
    </div>

</body>
</html>