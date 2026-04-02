<?php 
	require '../conn.php';
	session_start();
	$sql = 'UPDATE users SET connected="0" WHERE username="'.$_SESSION['user'].'"';
	$result = $conn_users->query($sql);
	session_logout();
	header('location:index.php');
?>