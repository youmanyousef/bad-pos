<!-- do not use this file on its own, must establish conn first.-->
<?php
	
	$sql = "select * from archive where id=$id";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc() ){
		$get_name = $row["name"];
	}

?>