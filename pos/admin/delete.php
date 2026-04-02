<?php

require '../conn.php';
// Create connection
$id = $_GET['id']; // get id through query string
//add later-purpose for delete
$reason = "force";
// include 'get_name_invoice.php';
// $name = $get_name;
// Read with ID, get the row
$sql = "select * from invoice";
$result = $conn->query($sql);
$name = "";
$archive = "";

if ($result->num_rows > 0){
	while($row = $result->fetch_assoc() ){
		$name = $row["name"];
			$time_start = $row["time_start"];
			$time_end = $row["time_end"];
			$email = $row["email"];
			$phone = $row["phone"];
			$type = $row["type"];
			$service = $row["service"];
			$notes = $row["notes"];
			$archive = "INSERT INTO archive VALUES (DEFAULT, '$time_start', '$time_end',
															 '$name', '$email', '$phone',
															 '$type', '$service','$notes')";
	}
}

$sql = mysqli_query($conn, $archive);
if($sql)
{
	$del = mysqli_query($conn,"delete from invoice where id = '$id'"); // delete query
	if($del)
	{
		$log = ("Removed ".$name."'s order (reason: ".$reason."), If this was a mistake, check in the Archive.");
		header("location:admin.php"); // redirects to all records page
	}
	else
	{
		$log = ("Error trying to delete the record for ".$name." from main page.");
	}
}
else
{
	$log = ("Error trying to archive the customer and order.");
	echo "Error deleting record\n"; // display error message if not delete
	echo $archive;
}
include 'log.php';
mysqli_close($conn); // Close connection
exit;
?>
