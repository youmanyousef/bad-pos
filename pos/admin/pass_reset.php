<?php
	require '../conn.php';
	
	$name = $_SESSION['user'];
	if (isset($_GET['current']) and isset($_GET['new']) and isset($_GET['new_conf'])) {
		
		// set values from form action
		$current = $_GET['current'];
		$new_pass = $_GET['new'];
		$conf_pass = $_GET['new_conf'];
		echo $new_pass." ".$conf_pass;
		if (strcmp($new_pass, $conf_pass) !== 0 ) {
			//check if passwords are good. 
			header("location:settings.php?err=pass");
		} else {
			$sql = 'SELECT * FROM `users` WHERE `username`="'.$name.'"';
			$result = $conn_users->query($sql);
			$row = $result->fetch_assoc();
			
			if(password_verify($current, $row['password'])) {
				$enc_pass = password_hash($new_pass, PASSWORD_DEFAULT);
				$sql = "UPDATE users SET `password`='$enc_pass' WHERE `username`='$name'";
				$insert = $conn_users->query($sql);
				if ($insert) {
					$log = "Changed password.";
					header("location:settings.php");
				} else {
					$log = "An unexpected error occured trying to change password.";
					header("location:settings.php?err=other");
				}
				include "log.php";
			} else {
				header("location:settings.php?err=inc");
			}
		}
		
	}
	
?>