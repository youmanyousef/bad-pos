<?php

require '../conn.php';		
$id = $_GET['id']; // get id through query string
include 'get_name_invoice.php';
$$name = $get_name;

//this is really bad but its ok for the time being
function print_var_name($var) {
    foreach($GLOBALS as $var_name => $value) {
        if ($value === $var) {
            return $var_name;
        }
    }
    return false;
}
/* $array = array($id);
echo print_var_name($array[0])."  ".$id; */
$name =  $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$type = $_REQUEST['device'];
$service = $_REQUEST['service'];
$time_start = $_REQUEST['time_start'];
$time_end = $_REQUEST['time_end'];
$notes = $_REQUEST['notes'];
$array = array($name, $email, $phone, $type, $service, $time_start, $time_end, $notes);
$index = 0;
$fill_index = 0;
$fill = array();
$list = "";
while($index < count($array))
{	
	//put whitespace regex?
	if ($array[$index] != "")
	{
		$fill[$fill_index] = $array[$index];
		$fill_index += 1;
	}
		//$list = $list ." ". print_var_name($array[$index])."='".$array[$index]."',";
	$index +=1;
}
$index = 0;
while($index < count($fill))
{	
	if ($index == (count($fill)-1))
		$list = $list ." ". print_var_name($fill[$index])."='".$fill[$index]."'";
	else
		$list = $list ." ". print_var_name($fill[$index])."='".$fill[$index]."',";
	$index +=1;
}

echo "<br>".$list;

$edit = mysqli_query($conn,"update invoice set $list where id = '$id'"); // delete query
if($edit)
{
    $log = "Updated fields for ". $$name."'s order.";
	header("location:admin.php"); // redirects to all records page
}
else
{
	$log = "Error: could not update ". $$name."'s order. Check if there was any empty inputs.";
    echo "Error updating record"; //
}
include 'log.php';
mysqli_close($conn); // Close connection
exit;	
?>