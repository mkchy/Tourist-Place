 <?php
	session_start();
	
	//connect to database
	$db = mysqli_connect("localhost", "root", "", "authentication");
	
	if(isset($_POST['register_btn'])){
		//session_start(['username']);
 		$username = mysqli_real_escape_string($db,$_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$password = mysqli_real_escape_string($db,$_POST['password']);
		$password2 = mysqli_real_escape_string($db,$_POST['password2']);
		
		if($password == $password2) {
			// create user
			$password = md5($password); //hash password before storing for security purposes
			$sql = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
			mysqli_query($db, $sql);
			$_SESSION['message'] = "You are now logged in";
			$_SESSION['username'] = $username;
			header("location: home.php"); //redirect to home page
		}else{
			$_SESSION['message'] = "The two passwords do not match";
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Please Register Here</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h1>Please Register Here</h1>
</div>

<?php
	if(isset($_SESSION['message'])) {
 		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
	}
	
?>

<form method="post" action="register.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" class="textInput"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="email" name="email" class="textInput"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" class="textInput"></td>
		</tr>
		<tr>
			<td>Password again:</td>
			<td><input type="password" name="password2" class="textInput"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="register_btn" value="Register"></td>
		</tr>
	</table>
</form>
</body>
</html>
