<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "users";
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
echo "Connection successful.";
//some extra, psuedo-global var
date_default_timezone_set('America/Los_Angeles'); //get local time. orangecounty == la;;idc
$time = (30*60); //time in seconds, edit settings.json file later.
session_start();
?>