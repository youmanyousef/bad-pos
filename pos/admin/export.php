<?php
	require '../conn.php';
	$sql = "select * from archive";
	$result = $conn->query($sql);
	if (! (isset($_GET['y']) and isset($_GET['m']))) {
		echo "no";
		die();
		exit;
	}
	function filterData(&$str){ 
		$str = preg_replace("/\t/", "\\t", $str); 
		$str = preg_replace("/\r?\n/", "\\n", $str); 
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
	}
	// Excel file name for download 
	$file_export = "";
	 
	// Headers for download 
	//header("Content-Disposition: attachment; filename=\"$fileName\""); 
	//header("Content-Type: application/vnd.ms-excel"); 
	 
	$flag = false; 
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc() ){
			if(!$flag) { 
				// display column names as first row 
				$col_names = array(
					"ID",
					"Time Started",
					"Time Ended",
					"Name",
					"Email",
					"Phone",
					"Type (check legend)",
					"Service",
					"Notes",
					"0 is Phone, 1 is Tablet, 2 is Computer. 0 is Other."
				);
				$file_export = $file_export.implode("\t", array_values($col_names)) . "\n"; 
				$flag = true; 
			} 
			// filter data 
			array_walk($row, 'filterData'); 
			$file_export = $file_export.implode("\t", array_values($row)) . "\n"; 
		}
	} else {$file_export = $file_export.'mayday';}
	mkdir('../export/'.$_GET['y'].'/'.$_GET['m'].'/', 0777, true);
	$xl_file = fopen('../export/'.$_GET['y'].'/'.$_GET['m'].'/export.xls','w');
	fwrite($xl_file, $file_export);
	
	##sql now
	$sql = "delete from archive";
	$result = $conn->query($sql);
	if ($result) 
	{
		$log = "Finished exporting for this month.";
	}
	else
	{
		$log = "An error occured while exporting this month's stuff.";
	}
	include 'log.php';
	header("location:admin.php");
	exit;
?>