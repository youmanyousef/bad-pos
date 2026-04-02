<?php

require '../conn.php';
$id = $_GET['id']; // get id through query string

//get values
$name =  $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$type = $_REQUEST['device'];
$service = $_REQUEST['service'];
$time_start = $_REQUEST['time_start'];
$time_end = $_REQUEST['time_end'];
$notes = $_REQUEST['notes'];

//send values
$sql = "insert into invoice (id, time_start, time_end, name, email, phone, type, service, notes) values (DEFAULT, '$time_start', '$time_end', '$name', '$email', '$phone', '$type', '$service', '$notes')"; 
$insert = mysqli_query($conn,$sql); 

if($insert)
{
	$del = mysqli_query($conn, "delete from client where id = '$id'");
    	
	$log = strval("Added customer to main page, removed record from accepting client table. \n" .
	"Customer: ".$name.", ".$type.", ".$service.".");	
	echo $log;
}
else
{
    echo "An error has occured during query."; 
	$log = ("Error trying to accept client into main page. If there are blank inputs, please fill them.");
}
include 'log.php';
mysqli_close($conn); // Close connection
header("location:admin.php"); // redirects to all records page
exit;
?>