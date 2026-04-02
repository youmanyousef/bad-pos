<?php
	require '../conn.php';
	$sql = "select * from archive";
	$result = $conn->query($sql);
	
	function filterData(&$str){ 
		$str = preg_replace("/\t/", "\\t", $str); 
		$str = preg_replace("/\r?\n/", "\\n", $str); 
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
	}
	// Excel file name for download 
	$fileName = "export-" . date('Y-m') . ".xlsx"; 
	 
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
				echo implode("\t", array_values($col_names)) . "\n"; 
				$flag = true; 
			} 
			// filter data 
			array_walk($row, 'filterData'); 
			echo implode("\t", array_values($row)) . "\n"; 
		}
	} else {echo 'mayday';}
	
	exit;
?>