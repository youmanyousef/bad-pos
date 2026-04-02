<?php
require '../conn.php';

if (!isset($_SESSION['user'])) {
	echo "Please login again.";
	echo "<a href='index.php'>Click Here to Login</a>";
} else {
	$now = time();
	if ($now > $_SESSION['expire']) {
		session_destroy();
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
	<script src="./js/service_edit.js"></script>
</head>
<body>
	<div class="navigation" id="navbar">
	</div>
	<div class="content">
		<?php
			$get_service = $_GET['service'];
		?>
		<form action="s_edit_action.php">
			<h1>Edit <?php echo $get_service;?>:</h1>
			<h6>X all of the inputs to remove the group name. Press Save Changes to exit. Leave page to cancel.</h6>
			<input type="hidden" name="service" value="<?php echo $get_service?>">
			<?php
				$json_file = file_get_contents('settings.json');
				$json_data = json_decode($json_file, true);
				$index = 0;
				foreach ($json_data as $key => $entry) {
					foreach	($json_data[$key]['service'] as $value)
					{
						if ($json_data[$key]['name'] == $get_service)
						{
							echo "<input type='text' required name='".$index."' id='".$index."' value='".$value."'>";
							echo "<button type='button' id='".$index."' onClick='del_btn(".$index.")'>X</button>";
							echo "<br id='s".$index."'>";
							$index++;
						}
					}
				}
			?>
			<script>index = <?php echo $index;?></script>
			<div id="para"></div>
			<input type="submit" value="Save Changes">
			
		</form>
		<button onClick="add_service()">Add New Service</button>
	</div>
	<div class="footer" id="footer">
	</div>	
</body>
<?php }} $_SESSION['expire'] = time() + $time; //update session expiration time. ?>