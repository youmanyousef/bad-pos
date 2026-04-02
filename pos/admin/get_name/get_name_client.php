<!-- do not use this file on its own, must establish conn first.-->
<?php
	
	function get_name_client($id, $conn) {
		$sql = "select * from client where id=$id";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc() ){
			return $row["name"];
		}
		return "N/A";
	}
?>