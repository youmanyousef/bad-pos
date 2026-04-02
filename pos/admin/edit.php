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
		//code..
		if (!isset($_GET['id'])) {
			header("location:admin.php"); // redirects to all records page
			exit;
		}
		$id = $_GET['id']; // get id through query string
		$sql = "select * from invoice where id=$id";
		$result = $conn->query($sql);


		while($row = $result->fetch_assoc() ){
			//quick fix for chromium devices
			$time_start = substr_replace($row['time_start'],'T',10,1);
			$time_end = substr_replace($row['time_end'],'T',10,1);
?>
<!DOCTYPE html>
<head>
	<title>POS ADMIN</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="./js/load_elements.js"></script>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
	<div class="navigation" id="navbar">
	</div>
	<div class="content">
		<form action="edit_action.php">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<label for="name"><h1>Name: </h1></label>
			<input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
			<label for="email"><h1>Email: </h1></label>
			<input type="text" id="email" name="email" value="<?php echo $row['email']; ?>">
			<label for="phone"><h1>Phone: </h1></label>
			<input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>">
			<table>
				<tr>
					<td>
						<h1>Device Type: </h1>
						<div id="devices">
							<input type="radio" id="phone" name="device" value="1">
							<label for="phone">Phone</label><br>
							<input type="radio" id="tablet" name="device" value="2">
							<label for="tablet">Tablet</label><br>
							<input type="radio" id="computer" name="device" value="3">
							<label for="computer">Computer</label><br>
							<input type="radio" id="other" name="device" value="0">
							<label for="other">Other</label><br>
						</div>
					</td>
					<td>
						<label for="service">Service Required: </label>
						<select name="service" id="service">
						<?php
						$json_file = file_get_contents('settings.json');
						$json_data = json_decode($json_file, true);
						echo $row['service'];
						foreach ($json_data as $key => $entry) {
							echo "<optgroup label='".$json_data[$key]['name'] . "'>";
							foreach ($json_data[$key]['service'] as $value){
								$service_val = strtoupper($value)." ".$json_data[$key]['suffix'];
								if ($service_val == $row['service'])
									echo "<option value='".$service_val."' selected>".$value."</option>";
								else
									echo "<option value='".$service_val." '>".$value."</option>";
							}
							echo "</optgroup>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<label for="time_start"><h1>Start Date: </h1></label>
						<input type="datetime-local" id="time_start" name="time_start" value="<?php echo $time_start; ?>">
					</td>
					<td>
						<label for="time_end"><h1>End Date: </h1></label>
						<input type="datetime-local" id="time_end" name="time_end" value="<?php echo $time_end; ?>">
					</td>
				</tr>
			</table>
			<label for="notes"><h1>Notes: </h1></label>
			<input type="text" id="notes" name="notes" value=<?php echo $row['notes']; ?>><br><br>
			<input type="submit" value="Confirm">
		</form>
	</div>
	<div class="footer" id="footer">
	</div>
</body>
<?php }}} $_SESSION['expire'] = time() + $time; //update session expiration time. ?>
