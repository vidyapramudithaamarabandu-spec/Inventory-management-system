<?php
$servername="localhost";
$username="root";
$password="";
$database="my_new_db";

$conn=mysqli_connect($servername,$username,$password,$database);

if($conn===false){
	die("Error:Connection failed:".mysqli_connect_error());
}

$insert_message = "";
$delete_message = "";

// 1. Handle Insert Request
if(isset($_POST['submit_supplier'])){
	$supplier_id=$_POST['supplier_id'];
	$name=$_POST['name'];
	$contact_no=$_POST['contact_no'];
	$address=$_POST['address'];
	
	$sql="INSERT INTO suppliers(supplier_id,name,contact_no,address) VALUES('$supplier_id','$name','$contact_no','$address')";
	
	if(mysqli_query($conn,$sql)){
		$insert_message="Recorded successfully!";
	}else{
		$insert_message="ERROR:could not be able to execute".mysqli_error($conn);
	}
}

// 2. Handle Delete Request
if(isset($_POST['delete_id'])){
    $idToDelete = $_POST['delete_id'];
    
    $sql="DELETE FROM suppliers WHERE supplier_id='$idToDelete'";
    
    if(mysqli_query($conn,$sql)){
        $delete_message="Supplier record successfully deleted!";
    }else{
        $delete_message="Error deleting record:".mysqli_error($conn);
    }
} // <--- THIS is the bracket that was missing in your file!

// 3. Fetch Data for Table
$sql_fetch="SELECT * FROM suppliers";
$result=mysqli_query($conn,$sql_fetch);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registered Suppliers</title>
	<style>
		body{
			background-color:#f8f9fa;
			font-family: 'Times New Roman', Times, serif;
			margin: 0;
			padding: 20px;
		}
		.Success-box{
			background-color:#d4edda;
			color: #155724;
			padding:20px 50px;
			border:1px solid #c3e6cb;
			border-radius:8px;
			font-size:22px;
			font-weight:bold;
			box-shadow:0 4px 10px rgba(0,0,0,0.1);
			text-align:center;
			margin: 0 auto 20px auto;
			width: 50%;
		}
		.back-btn{
			display:block;
			width: 150px;
			margin: 15px auto;
			padding:8px 16px;
			background-color:Darkblue;
			color:white;
			text-decoration:none;
			border-radius:4px;
			font-size:16px;
			text-align: center;
		}
		.back-btn:hover{
			background-color:lightblue;
			color: black;
		}
		table {
			margin: 0 auto;
			border-collapse: collapse;
			width: 80%;
			background-color: white;
		}
		th, td {
			border: 1px solid #ccc;
			padding: 10px;
			text-align: center;
		}
		th {
			background-color: #f9f9f9;
		}
		h2 {
			text-align: center;
			text-transform: uppercase;
			margin-bottom: 20px;
		}
		.delete-message{
			color: #d9534f;
			font-size: 18px;
			font-weight: bold;
			text-align: center;
			margin-top: 20px;
		}
	</style>
</head>
<body>

	<?php if($insert_message): ?>
		<div class="Success-box">
			<?php echo $insert_message; ?>
		</div>
	<?php endif; ?>

	<a href="SUPPLIER.html" class="back-btn">Go Back to Form</a>

	<h2>Registered Supplier</h2>

	<table>
		<tr>
			<th>ID</th>
			<th>Supplier Name</th>
			<th>Contact</th>
			<th>Address</th>
			<th>Action</th>
		</tr>
		
		<?php
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
		?>
		<tr>
			<td><?php echo htmlspecialchars($row['supplier_id']); ?></td>
			<td><?php echo htmlspecialchars($row['name']); ?></td>
			<td><?php echo htmlspecialchars($row['contact_no']); ?></td>
			<td><?php echo htmlspecialchars($row['address']); ?></td>
			<td>
				<form method="POST" action="" style="margin: 0;">
					<input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['supplier_id']); ?>">
					<input type="submit" value="Delete" style="background-color: #d9534f; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;" onclick="return confirm('Are you sure you want to delete this supplier?');">
				</form>
			</td>
		</tr>
		<?php
			}
		}else{
			echo"<tr><td colspan='5' style='text-align:center;'>No suppliers found.</td></tr>";
		}
		?>
	</table>

	<?php if($delete_message): ?>
		<div class="delete-message">
			<?php echo $delete_message; ?>
		</div>
	<?php endif; ?>

</body>
</html>

<?php
// Close connection at the very end
mysqli_close($conn);
?>