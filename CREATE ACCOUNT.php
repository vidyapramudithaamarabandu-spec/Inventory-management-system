<?php
$host="localhost";
$username="root";
$password="";
$dbname="my_new_db";

$conn = new mysqli($host,$username,$password,$dbname);

if($conn->connect_error){
	die("Connection failed:".$conn->connect_error);
}

$message="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	$username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Check if the username already exists in the 'users' table
    $checkuser = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $checkuser->bind_param("s", $username);
    $checkuser->execute();
    $result = $checkuser->get_result();

    if ($result->num_rows > 0) {
        $message = "<p style='color:red;'>Username already taken!</p>";
    } else {
        // 2. Username is free, so insert the new account
        $stmt = $conn->prepare("INSERT INTO users (username, password_harch) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $message = "<p style='color:green;'>Account created! <a href='LOGIN.php'>Login here</a></p>";
        } else {
            $message = "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
    $checkuser->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device,initial-scale=1.0">
	<title>CREATE ACCOUNT | IMS SYSTEM</title>
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
	<h2>IMS | CREATE ACCOUNT</h2>
	<?php echo $message;?>
	<form action="CREATE ACCOUNT.php" method="POST">
	<div class="input-group">
		<lable for="username">Username</lable>
		<input type="text" id="username" name="username" placeholder="Create your Username" required>
	</div>
	<div class="input-group">
		<lable for="password">Password</lable>
		<input type="password" id="password" name="password" placeholder="Create your password" required>
	</div>
	<button type="submit" class="login-btn">Create Account</button>
	</form>
</div>
</body>
</html>