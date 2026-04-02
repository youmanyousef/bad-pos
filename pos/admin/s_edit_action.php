<?php	
$get_service = $_GET['service']; // get service through query string
/*$service_de = '{
		"name": "'.$get_service.'",
		"service": [],
		"suffix": "'.$get_suffix.'"
	}'; // setup JSON object 
//echo $service_de; // debug*/
$json_file = file_get_contents('settings.json');
$json_data = json_decode($json_file, true);// take file
$insert = false;
$service_de = array();
$service_de[0] = $_GET['0'];
if (!$service_de[0])
{
	foreach ($json_data as $key => $value)
	{
		if($json_data[$key]['name'] == $get_service )
			unset($json_data[$key]);
	}
	
}
else
{
	foreach ($_GET as $key => $value) 
	{
		if ((int)$key != null )
			$service_de[$key] = $value;
	}

	print_r($service_de);


	foreach ($json_data as $key => $value)
	{
		if($json_data[$key]['name'] == $get_service)
		{
			$json_data[$key]['service'] = $service_de;// add object
			print_r($json_data[0]['service']);
			$insert = true;
		}
	}
}


$push_to_file = json_encode($json_data);// encode string
file_put_contents('settings.json', $push_to_file);// push all of it back to settings file.



if($insert)
{    	
	$log = strval("Added to the service ".$get_service.".");	
	echo $log;
}
else
{
    echo "An error has occured while adding service for: ".$get_service."."; 
	$log = ("An error has occured while adding service for: ".$get_service.".");
}
include 'log.php';
header("location:settings.php"); // redirects to settings page
exit;
?>