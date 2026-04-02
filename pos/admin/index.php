<?php
if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}
	require '../conn.php';
	if (isset($_POST['submit'])) {
		$name = $_POST['username'];
		$pass = $_POST['password'];
		
		$sql = 'SELECT * FROM `users` WHERE `username`="'.$name.'"';
		$result = $conn_users->query($sql);
		$row = $result->fetch_assoc();
		
		$db_name = $row['username'];
		$db_pass = $row['password'];
		
		if ($db_name == $name && password_verify($pass, $db_pass )) {
			//tell client side its logged in?
			$sql = 'UPDATE users SET connected="1" WHERE username="'.$name.'"';
			$result = $conn_users->query($sql);
			
			$_SESSION['user'] = $name;
			$_SESSION['start'] = time(); //start timer
			$_SESSION['expire'] = $_SESSION['start'] + $time;
			
			$json = array('user' => ''.$name.'');
			$push_to_file = json_encode($json);// encode string
			file_put_contents('user.json', $push_to_file);// push all of it back
			header('location:admin.php');
		} else {
			echo "Invalid Credentials. Try again.";
		}
		
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>POS ADMIN</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="./css/style.css" defer>
	</head>
	<body>
		<div class="navigation" id="navbar">	
		</div>
		<div class="content">
			<form action="?">
				
			</form> 
			<h1>login</h1>
			<form name="login_form" method="post">
				<label>Enter Username: </label>
				<input type="text" name="username" required><br>
				<label>Enter Password: </label>
				<input type="text" name="password" required><br>
				<input type="submit" name="submit" value="Log in">
			</form>
		</div>
		<div class="footer" id="footer">
		</div>	
	</body>
</html>

