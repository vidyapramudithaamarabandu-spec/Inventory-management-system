<?php 
$conn=mysqli_connect("localhost","root","","my_new_db");

if(!$conn){
	die("Connection failed:".mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$p_id=$_POST['product_id'];
	$qty=$_POST['qty'];
	$type=$_POST['action_type'];
	
	if($type=="in"){
		$sql="UPDATE product SET current_stock = current_stock + $qty WHERE id=$p_id";	
	}else{
		$sql="UPDATE product SET current_stock = current_stock - $qty WHERE id=$p_id";
	}
	if(mysqli_query($conn,$sql)){
		$log_sql="INSERT INTO stock_log (product_id,type,quantity) VALUES ('$p_id','$type','$qty')";
		mysqli_query($conn,$log_sql);
		header("Location:Instock.php");
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTFF-8">
	<title>Instock</title>
	<link rel="stylesheet" href="Instock.css">
	<link rel="icon" type="Images/png" href="Images/Logo.png">
</head>
<body>
	<div class="container">
		<h1>Stock Control System</h1>
		<center><button><a href="DASHBOARD.php">Home</button></a></center><br>
		<div class="card">
			<h2>Update Inventory</h2>
			<form method="POST">
				<lable>Select Product</lable>
				<select name="product_id" required>
					<option value="">--choose Product--</option>
					<?php
					$res = mysqli_query($conn,"SELECT id,product_name,product_category FROM product");
					while($row=mysqli_fetch_assoc($res)){
						echo"<option value='".$row['id']."'>".$row['product_name']."(".$row['product_category'].")</option>";
					}
					?>
				</select>
				<label>Action Type</label>
				<select name="action_type" required>
					<option value="in">In Stock (+)</option>
					<option value="out">Out Stock (-)</option>
				<select>
				<lable>Quantity</lable>
				<input type="number" name="qty" min="1" required>
				
				<button type="submit" class="btn">Update Database</button>
			</form>
		</div>
		<!--inventory Table-->
		<div class="card">
			<h2>Current Stock Levels</h2>
			<table border="1" width="100%" style="border-collapse:collapse;">
				<thead>
					<tr style="background:#f4f4f4;">
						<th>ID</th>
						<th>Products Name</th>
						<th>Category</th>
						<th>Current Stock</th>
					</tr>
				</thead>
					<tbody>
						<?php
						$inventory = mysqli_query($conn,"SELECT * FROM product");
						while($item = mysqli_fetch_assoc($inventory)){
							echo "<tr>
									<td>".$item['id']."</td>
									<td>".$item['PRODUCT_NAME']."</td>
									<td>".$item['product_category']."</td>
									<td style='font-weight:bold;'>".$item['current_stock']."</td>
								</tr>";
						}
						?>
					</tbody>
			</table>
		</div>
	</div>
</body>	
</html>		

