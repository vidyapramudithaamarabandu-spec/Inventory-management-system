<?php
session_start();

if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!==true){
	header("Location:LOGIN.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="icon" type="Image/png" href="Images/Logo.png">
	<style>
	body{
		font-family:Times New Romen;
		background-color:#f4f7f6;
		display:grid;
		justify-content:center;
		align-items:center;
		height:100vh;
		margin:0;
	}
	.form-container{
		background-color:#ffffff;
		padding:30px 40px;
		border-radius:8px;
		box-shadow:0 4px 10px rgba(0,0,0,0.1)
		width:20px;
		max-width:100px;
	}
	h2{
		text-align:center;
		color:#3333333;
		margin-bottom:24px;
	}
	.form-group{
		margin-bottom:15px;
	}
	lable{
		display:block;
		margin-bottom:5px;
		font-weigth:600;
		color:#555555;
		font-size:14px;
	}
	input[type="text"],
	input[type="tel"],
	input[type="email"],
	text-area{
		width:100%;
		padding:10px;
		border-radius:4px;
		box-sizing:border-box;
		font-size:14px;
		font-family:inherit;
	}
	input[type="text"]:focus,
	input[type="tel"]:focus,
	input[type="email"]:focus,
	textarea:focus{
		border-color:#007bff;
		outline:none;
		box-shadow:0 0 4px rgba(0,123,255,0.2)
	}
	text-area{
		resize:vertical;
		height:80px;
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
	footer{
		background-color:black;
		color:white;
		text-align:center;
	}
	a{
		text-decoration-line:none;
		color:white;
	}
	</style>
	</head>
<script>
const logoutButton = document.getElementById('logout-btn');

logoutButton.addEventListener('click', async () => {
    try {
        localStorage.removeItem('userToken');
        sessionStorage.clear();

        alert('You have been successfully Logged Out.');
        window.location.href = 'login.php'; // Updated to relative path
    } catch (error) {
        console.error('Error during logout:', error);
        alert('Something went wrong. Please try again.'); // Fixed 'alter' typo
    }
});
</script>
	

<body>
	<center>
	<h1>INVENTORY MANAGEMENT SYSTEM</h1>
		<button><a href="ADD OR REVIEW PRODUCT.html">Products</button></a>
		<button><a href="ADD OR REVIEW SUPPLIER.html">Suppliers</button></a><br>
		<button><a href="Instock.php">Stock Control System</button></a>
		<button><a href="sales.php">Sales</button></a><br>
		<button><a href="USER ACCESS CONTROL.php">Manage users</button></a>
	</center>
<button style="background-color:red;"href="Logout.php">Logout</button>
<footer>&copy;Copyright 2026 Inventory Management System<br>Produced and Distributed by<br><highlight style="color:red;">Suduneluma Food Products</highlight></footer>
</body>
</html>