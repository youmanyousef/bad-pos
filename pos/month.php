<!DOCTYPE html>
<?php

// get the month from file
// check if it is the same as last month
// if not
// -- check if that year + month file exists
// -- if not
// -- -- figure out how to export method, wheter thats xlsx on machine or extra db+tables
$json_file = file_get_contents('month.json');
$json_data = json_decode($json_file, true);
$mon = date("F");
$year = date("Y");
if ($json_data['month'] != $mon) {
	echo "t";
	$dir = "./export/".$json_data['year']."/".$json_data['month']."/";
	if (file_exists($dir."export.xls")) {
		echo "already exists";
	} else {
		if (!file_exists($dir)) {
			if (!file_exists("./export/".$json_data['year']."/"))
				mkdir("./export/".$json_data['year']."/");
			mkdir($dir);
		}
		header("location:./export.php?y=".$json_data['year']."&m=".$json_data['month']);
	}
	$json = array('month' => ''.$mon.'', 'year' => ''.$year.'');
	$push_to_file = json_encode($json);// encode string
	file_put_contents('month.json', $push_to_file);// push all of it back
}
?>
