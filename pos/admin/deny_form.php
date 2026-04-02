<?php

require '../conn.php';	//connect to db	
$id = $_GET['id']; // get id through query string
$name = get_name($id, $conn, 'client'); //grab the name for logging
$del = mysqli_query($conn,"delete from client where id = '$id'"); // delete query

if($del)
{
	$log = ("Denied order from ".$name."");
	header("location:admin.php"); // redirects to all records page
}
else
{
	$log = ("Error trying to deny order from ".$name.". Possibly a duplicate hidden ID.");
    echo "Error deleting record"; // display error message if not delete
}
include 'log.php';
exit;
?>