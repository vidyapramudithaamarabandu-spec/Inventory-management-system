<?php 
$conn = mysqli_connect("localhost", "root", "", "my_new_db");

if(!$conn){
    die("Connection failed:" . mysqli_connect_error());
}

$message = ""; // Variable to hold success or error messages

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Using intval() adds a layer of security to prevent SQL Injection
    $p_id = intval($_POST['product_id']);
    $qty = intval($_POST['qty']);
    $type = "sale"; // Hardcoded to 'sale' since this is strictly a sales form
    
    // First, check if there is enough stock to make the sale
    $check_sql = "SELECT current_stock, product_name FROM product WHERE id = $p_id";
    $result = mysqli_query($conn, $check_sql);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if($row['current_stock'] >= $qty) {
            // Deduct the quantity from current stock
            $sql = "UPDATE product SET current_stock = current_stock - $qty WHERE id = $p_id";
            
            if(mysqli_query($conn, $sql)){
                // Log the transaction
                $log_sql = "INSERT INTO stock_log (product_id, type, quantity) VALUES ('$p_id', '$type', '$qty')";
                mysqli_query($conn, $log_sql);
                $message = "<div class='alert success'>Successfully sold $qty of " . $row['product_name'] . "!</div>";
            }
        } else {
            // Error if trying to sell more than available
            $message = "<div class='alert error'>Not enough stock! You only have " . $row['current_stock'] . " items available.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <title>Sales Register</title>
    <link rel="icon" type="image/png" href="Images/Logo.png"> <style>
        /* Provided a basic embedded CSS so the page looks neat instantly */
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; }
        h1 { text-align: center; color: #333; }
        .card { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .btn-home { display: inline-block; padding: 10px 15px; background: #333; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px;}
        .btn-submit { background: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer; font-size: 16px; width: 100%; margin-top: 15px; }
        .btn-submit:hover { background: #218838; }
        label { font-weight: bold; display: block; margin-top: 10px; margin-bottom: 5px; }
        select, input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .low-stock { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales</h1>
        <center><a href="DASHBOARD.php" class="btn-home">Home</a></center>
        
        <div class="card">
            <h2>Record a Sale</h2>
            
            <?php echo $message; ?>

            <form method="POST">
                <label>Select Product</label>
                <select name="product_id" required>
                    <option value="">-- Choose Product to Sell --</option>
                    <?php
                    // Only show products that have stock > 0
                    $res = mysqli_query($conn, "SELECT id, product_name, product_category, current_stock FROM product WHERE current_stock > 0");
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<option value='".$row['id']."'>".$row['product_name']." (".$row['product_category'].") - ".$row['current_stock']." left</option>";
                    }
                    ?>
                </select>
                
                <label>Quantity to Sell</label>
                <input type="number" name="qty" min="1" required>
                
                <button type="submit" class="btn-submit">Complete Sale</button>
            </form>
        </div>

        <div class="card">
           <h2>Live Stock Levels</h2>
           <table>
             <thead>
                <tr>
                   <th>ID</th>
                   <th>Product Name</th>
                   <th>Category</th>
                   <th>Current Stock</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    $inventory = mysqli_query($conn, "SELECT * FROM product");
                    while($item = mysqli_fetch_assoc($inventory)){
                        // Highlight stock in red if it hits 0
                        $stock_display = $item['current_stock'] <= 0 
                            ? "<span class='low-stock'>Out of Stock</span>" 
                            : $item['current_stock'];

                        echo "<tr>
                                <td>".$item['id']."</td>
                                <td>".$item['PRODUCT_NAME']."</td>
                                <td>".$item['product_category']."</td>
                                <td>".$stock_display."</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>    
</html>