<?php
session_start();
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="my_new_db";

$conn=new mysqli($host,$dbusername,$dbpassword,$dbname);

if($conn->connect_error){
	die("Connection failed:".$conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	$stmt=$conn->prepare("SELECT id,username,password_harch FROM users WHERE username=?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result=$stmt->get_result();
	
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
		
		if($password==$row['password_harch']){
		
		$_SESSION['loggedin']=true;
		$_SESSION['id']=$row['id'];
		$_SESSION['username']=$row['username'];
		
		header("Location:DASHBOARD.php");
		exit();
		}else{
			$error_message="Incorrect Password!";
		}
		}else{
			$error_message="Username not found!";
		}
		$stmt->close();
	}
	$conn->close();
?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1.0">
	<title>LOGIN | IMS SYSTEM</title>
	<link rel="stylesheet" href="LOGIN.css">
<style>
*{
	margin:0;
	padding:0;
	box-sizing:border-box;
	font-family:Times New Romen;
}
body{
	background-color:#f0f2f5;
	display:flex;
	justify-content:center;
	align-items:center;
	height:100vh;
}
.login-container{
	background-color:#ffffff;
	padding:40px;
	border-radius:10px;
	box-shadow:0 8px 20px rgba(0,0,0,0.1);
	width:100%;
	max-width:400px;
}
.input-container h2{
	text-align:center;
	margin-bottom:30px;
	color:#333333;
	font-size:24px;
}
.input-group{
	margin-bottom:20px;
}
.input-group lable{
	display:block;
	margin-bottom:8px;
	color:#5555555;
	font-weight:500;
	font-size:14px;
}
.input-group input{
	width:100%;
	padding:12px;
	border:1px solid #cccccc;
	border-radius:6px;
	outline:none;
	font-size:15px;
	transition:border-color 0.3s ease;
}
.input-group input:focus{
	border-color:#007bff;
}
.login-btn{
	width:100%;
	padding:12px;
	background-color:#007dff;
	color:white;
	border:none;
	border-radius:6px;
	font-size:16px;
	font-weight:bold;
	cursor:pointer;
	transition:background-color 0.3s ease;
	margin-top:10px;
}
.login-btn:hover{
	background-color:#0056b3;
}
.extra-link{
	display:flex;
	justify-content:space-between;
	margin-top:20px;
	font-size:14px;
}
.extra-link a{ 
	color:#007bff;
	text-decoration:none;
	transition:color 0.3s ease;
}
.extra-link a:hover{
	color:#0056b3;
	text-decoration:underline;
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
	
</style>
</head>
<body>
	<div class="login-container">
		<h2>IMS | LOGIN</h2>
		<form action="LOGIN.php" method="POST">
		
		<div class="input-group">
			<lable for="username">Username</lable>
		<input type="text" id="username" name="username" placeholder="Enter Your User Name" required>
	</div>
	
	<div class="input-group">
		<lable for="password">Password</lable>
		<input type="password" id="password" name="password" placeholder="Enter your password" required>
	</div>
	<button type="submit" class="Login-btn">LOGIN</button>
	
	<div class="extra-link">
		<a href="CREATE ACCOUNT.php">Create an Account</a>
	</div>
</form>
</div>
</body>
</html>
