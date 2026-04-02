<?php	
$get_service = $_GET['service']; // get service through query string
$get_suffix = strtoupper($_GET['suffix']); //get suffix param through query string
$service_de = '{
		"name": "'.$get_service.'",
		"service": [],
		"suffix": "'.$get_suffix.'"
	}'; // setup JSON object 
//echo $service_de; // debug
$service = json_decode($service_de, true); //convert to JSON
$json_file = file_get_contents('settings.json');
$json_data = json_decode($json_file, true);// take file as well
$insert = array_push($json_data, $service);// add object from before and apend to it
$push_to_file = json_encode($json_data);// encode string
file_put_contents('settings.json', $push_to_file);// push all of it back to settings file.



if($insert)
{    	
	$log = strval("Added ".$get_service." to the service tray.");	
	echo $log;
}
else
{
    echo "An error has occured while adding service: ".$get_service."."; 
	$log = ("");
}
include 'log.php';
header("location:settings.php"); // redirects to settings page
exit;
?>