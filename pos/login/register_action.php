<?php
require 'conn.php';


if (isset($_GET['username'])) {
	if (isset($_GET['password'])) {
		$user = $_GET['username'];
		$pass = $_GET['password'];
		
		$enc_pass = password_hash($pass, PASSWORD_DEFAULT);
		echo $enc_pass."<br>";
		$sql = "INSERT IGNORE INTO users VALUES (DEFAULT, '$user','$enc_pass','./user')";
		$insert = mysqli_query($conn, $sql);
		if($insert)
			echo "";
		else
			echo "<br>err";
		
	}
}
?>
