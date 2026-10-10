<?php
$conn=mysqli_connect("localhost","root","","my_new_db");

if(!$conn){
	die("Connection Failed".mysqli_connect_error());
}
$sql="SELECT * FROM product";
$result=mysqli_query($conn,$sql)or die(MYSQLI_ERROR($conn));
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADDED PRODUCTS</title>
	<link rel="icon" type="Image/png" href="Images/Logo.png">
	<style>
	table{
		border-collapse:collapse;
		width:100%;
		font-family:'Times New Romen',serif;
	}
	th,td{
		border:1px solid #dddddd;
		padding:12px;
		text-align:left;
	}
	th{
		background-color:#f4f4f4;
	}
	body{
	font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
	background-color:#f4f7f6;
	color:#333;
	margin:0;
	padding:20px;
}
button{
		width:200px;
		padding:12px;
		background-color:#007bff;
		border:none;
		color:white;
		font-size:16px;
		font-weight:bold;
		border-radius:4px;
		cursor:pointer;
		transition:background-color 0.3s;
		margin-top:10px;
	}
	button:hover{
		background-color:#0056b3;
	}
.container{
	max-width:900px;
	margin:0 auto;
}
h1{
	text-align:center;
	color:#1a1a1a;
	margin-bottom:30px;
}
.card{
	background:#ffffff;
	padding:25px;
	margin-bottom:25px;
	border-radius:8px;
	box-shadow:0 4px 6px rgba(0,0,0,0.1);
}
h2{
	margin-top:0;
	font-size:1.4rem;
	color:#2c3e50;
	border-bottom:2px solid #eee;
	padding-bottom:10px;
}
lable{
	display:block;
	margin-top:15px;
	margin-bottom:5px;
	font-weight:600;
}
select,input[type="number"]{
	width:100%;
	padding:12px;
	border:1px solid #ddd;
	border-radius:5px;
	font-size:1rem;
	box-sizing:border-box;
}
.btn{
	display:block;
	width:100%;
	background-color:#3498db;
	color:white;
	border:none;
	padding:12px;
	margin-top:20px;
	border-radius:5px;
	font-size:1.1rem;
	font-weight:bold;
	cursor:pointer;
	transition:background 0.3s ease;
}
.btn:hover{
	background-color:#3980b9;
}
table{
	width:100%;
	border-collapse:collapse;
	margin-top:15px;
	background-color:white;
}
th,td{
	text-align:left;
	padding:12px 15px;
	border-bottom"1px solid #edf2f7;
}
th{
	background-color:#f8f9fa;
	color:#4a5568;
	text-transform:uppercase;
	font-size:0.85rem;
	letter-spacing:0.05em;
}
tr:hover{
	background-color:#f1f7ff;
}
@media(max-width:600px){
	.container{
		padding:10px;
}
}
a{
	text-decoration-line:none;
	color:white;
}

	</style>
</head>
<body>
<center><h2>REGISTERED PRODUCTS</h2></center>
<table>
	<tr>
		<th>Product Name</th>
		<th>Product category</th>
		<th>brand</th>
		<th>contact_no</th>
		<th>Email</th>
		<th>Address</th>
	</tr>
	<?php
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			echo "<tr>";
			
			echo "<td>".$row["PRODUCT_NAME"]."</td>";
			echo "<td>".$row["product_category"]."</td>";
			echo "<td>".$row["brand"]."</td>";
			echo "<td>".$row["contact_no"]."</td>";
			echo "<td>".$row["email"]."</td>";
			echo "<td>".$row["ADDRESS"]."</td>";
			echo"</tr>";
		}
	}else{
		echo "<tr><td colspan='6'>No products found in the database</td></tr>";
	}
	mysqli_close($conn);
	?>
</table>
</body>
</html>
