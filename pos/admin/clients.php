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
		<table>
		<tr id="legend">
			<th>  ID </th> 
			<th>  Name  </th>
			<th>  Phone  </th>
			<th>  Email  </th>
			<th>  Accept Order?</th>
			<!--th>  Edit </th>
			<th>  Delete </th-->
		</tr> 
		<?php
			$sql = "select * from client";
			$result = $conn->query($sql);
	
		
			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc() ){
					echo "<tr>";
					echo "<td>".$row["id"]. "</td>";
					echo "<td>". $row["name"] . "</td>";
					echo "<td>".$row["phone"]. "</td>";
					echo "<td>".$row["email"]. "</td>";
					echo "<td>";
					echo "<a href='accept_form.php?id=".$row["id"]."'><img src='../images/ok.png'></a>";
					echo "<span style='margin-left:24px;'></span>";
					echo "<a href='deny_form.php?id=".$row["id"]."'><img src='../images/del.png'></a>";
					echo "</td>";
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
