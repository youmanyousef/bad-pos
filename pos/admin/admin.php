<?php
require '../conn.php';
//checking if session still exists
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="./js/load_elements.js"></script>
	<script src="./js/device_type.js"></script>
	<script src="./js/sorting.js"></script>
	<link rel="stylesheet" href="./css/style.css" defer>
</head>
<body>
	<div class="navigation" id="navbar">	
	</div>
	<div class="content">
	<form action="?">
		<input type="hidden" name="sort" value='<?php if(isset($_GET['sort'])) {echo $_GET['sort'];} ?>'>
		<input type="hidden"name="order" value="<?php if(isset($_GET['order'])) {echo $_GET['order'];} ?>">
		<input type="text" name="search" placeholder="Enter Query:">
		Filter by:
		<select name="filter">
			<option value="name">Name</option>
			<option value="time_start">Time Started</option>
			<option value="time_end">Time Ended</option>
			<option value="email">Email</option>
			<option value="phone">Phone</option>
			<option value="service">Service Required</option>
			<option value="notes">Notes</option>
		</select>
		<input type="submit" value="Search">
	</form>
	<table>
		<tr id="legend">
			<th><a id="id" href="">  ID  </button></th> 
			<th><a id="time_start" href="">  Time Started  </a></th>
			<th><a id="time_end" href="">  Time Ended </a></th>
			<th><a id="name" href="">  Name  </a></th>
			<th><a id="email" href="">  Email  </a></th>
			<th><a id="phone" href="">  Phone  </a></th>
			<th><a id="type" href="">  Device Type  </a></th>
			<th><a id="service" href="">  Service Required  </a></th>
			<th><a id="notes" href="">  Notes </a></th>
			<th>  Edit </th>
			<th>  Delete </th>
		</tr> 
	<?php
		$find = "";
		$sort = "";
		if (count($_GET) > 1) {
			$order = $_GET['order'];
			$search = "";
			$filter = "";
			if (isset($_GET['search']))
				$search = $_GET['search'];
			if (isset($_GET['filter']))
				$filter = $_GET['filter'];
			
			if ($search != "")
				$find = " WHERE ".$filter." LIKE '%".$search."%'";
			if ($order)
				$sort = " ORDER BY invoice.".$_GET['sort']." ".$order;	
			
		}
		$sql = "select * from invoice".$find.$sort;
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc() ){
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
				echo "<td><a href='edit.php?id=".$row["id"]."'><img src='../images/edit.png'></td>";
				echo "<td><a href='delete.php?id=".$row["id"]."'><img src='../images/del.png'></td></tr>";
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
