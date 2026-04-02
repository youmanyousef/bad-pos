<?php
require '../conn.php';

if (!isset($_SESSION['user'])) {
	echo "Please login again.";
	echo "<a href='index.php'>Click Here to Login</a>";
} else {
	$now = time();
	if ($now > $_SESSION['expire']) {
		session_logout();
		echo "You have been logged out due to inactivity.";
		echo "<a href='index.php'>Click Here to Login</a>";
	} else {
?>
<!DOCTYPE html>
<head>
	<title>POS ADMIN</title>
	<link rel="stylesheet" href="./css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="./js/load_elements.js"></script>
	<script src="./js/device_type.js"></script>
</head>
<body>
	<div class="navigation" id="navbar">
	</div>
	<div class="content">
	<button value="Browse records" id="browse_btn"><a href="browse.php" id="link">Browse records</a></button>
	<table>
		<tr id="legend">
			<th>  ID </th> 
			<th>  Time Started  </th>
			<th>  Time Ended </th>
			<th>  Name  </th>
			<th>  Email  </th>
			<th>  Phone  </th>
			<th>  Device Type  </th>
			<th>  Service Required  </th>
			<th>  Notes </th>
		</tr> 
	<?php
		$sql = "select * from archive";
		$result = $conn->query($sql);

		
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc() ){
			//echo "<tr> <td>".$row["id"]. "</td> <td>". $row["time_start"] . "</td> <td>".$row["time_end"]. "</td> <td>".$row["name"]. "</td> <td>".$row["contact"]. "</td><td>".$row["type"]. "</td> <td>".$row["service"]. "</td> <td>".$row["notes"]. "</td> <td><a href='edit.php?id=".$row["id"]."'><img src='edit.png'></td> <td><a href='delete.php?id=".$row["id"]."'><img src='del.png'></td></tr>";
				echo "<tr>";
				echo "<td>".$row["id"]. "</td>";
				echo "<td>". $row["time_start"] . "</td>";
				echo "<td>".$row["time_end"]. "</td>";
				echo "<td>".$row["name"]. "</td>";
				echo "<td>".$row["email"]. "</td>";
				echo "<td>".$row["phone"]. "</td>";
				echo "<td>";
				echo "<script>";
				echo "document.write(deviceType(".$row["type"]."));";
				echo "</script>";
				echo "</td>";
				echo "<td>".$row["service"]. "</td>";
				echo "<td>".$row["notes"]. "</td>";
				echo "</tr>";
			}
		} else {
			echo "0 records";
		}

		$conn->close();
	?>
	</table>
	</div>
	<div class="footer" id="footer">
	</div>	
</body>
<?php }} $_SESSION['expire'] = time() + $time; //update session expiration time. ?>