<?php
require 'conn.php';
?>
<!DOCTYPE html>
<html>
	<head>
		
		
	</head>
	<body>
		<h1>login</h1>
		<form name="login_form" method="post">
			<label>user</label>
			<input type="text" name="username" required><br>
			<label>pass</label>
			<input type="text" name="password" required><br>
			<input type="submit" name="submit" value="Log in">
		</form>
		<a href="register.php" class="button">Register</a><br>
		
	</body>
</html>
<?php
	if (isset($_POST['submit'])) {
		$name = $_POST['username'];
		$pass = $_POST['password'];
		
		$sql = 'SELECT * FROM `users` WHERE `username`="'.$name.'"';
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$db_name = $row['username'];
		$db_pass = $row['password'];;
		
		if ($db_name == $name && password_verify($pass, $db_pass )) {
			$_SESSION['user'] = $name;
			$_SESSION['start'] = time(); //start timer
			//-
			$_SESSION['expire'] = $_SESSION['start'] + $time;
			
			
			
			header('location:session.php');
		} else {
			echo "Invalid Credentials. Try again.";
		}
		
	}
	
?>