<?php
require '../conn.php';

$pass_err = "<p style='display:none'>";

if(isset($_GET['err'])) {
	$err = $_GET['err'];
	if (strcmp($err, "pass") == 0) 
		$pass_err = "<p style='color:red'>Passwords do not match.";
	else if (strcmp($err, "inc") == 0)
		$pass_err = "<p style='color:red'>Current password was incorrect.";
	else if (strcmp($err, "other") == 0)
		$pass_err = "<p style='color:red'>Something unexpected happened";
}



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
	<script src="./js/pass.js"></script>
</head>
<body>
	<div class="navigation" id="navbar">
	</div>
	<div class="content">
		<h1>Update Services: </h1>
		<form action="s_add_action.php">
			<label for="service">Add a group and its label:</label>
			<input type="text" name="service" required placeholder="** Repairs">
			<input type="text" name="suffix" required placeholder="GEN or GLASS">
			<input type="submit" value="Add">
		</form>
		
		<form action="s_edit.php">
			<label for="service">Edit a group:</label>
			<select name="service" id="service">
				<?php
				$json_file = file_get_contents('settings.json');
				$json_data = json_decode($json_file, true);
				foreach ($json_data as $key => $entry) {
					echo "<option value='".$json_data[$key]['name']."'>".$json_data[$key]['name']."</option>";//.strtoupper($value)." ".$json_data[$key]['suffix'].
				}
				?>
			<input type="submit" value="Select">
		</form>
		<h1>Change Login Credentials:</h1>
		<?php echo $pass_err?></p>
		<form action="pass_reset.php">
			<!-- add view password -->
			<style>a {text-decoration: none;}</style>
			<label for="current">Current Password: </label>
			<input type="password" name="current" id="c_pass" required> <a id="c" href="javascript:void(0)" onclick="check('c_pass','c')">&#128065;</a><br>
			<label for="">New Password:</label>
			<input type="password" name="new" id="new" required> <a id="n" href="javascript:void(0)" onclick="check('new','n')">&#128065;</a><br>
			<label for="">Confirm Password:</label>
			<input type="password" name="new_conf" id="conf" required> <a id="n2" href="javascript:void(0)" onclick="check('conf','n2')">&#128065;</a><br>
			<input type="submit" >
		</form>
	</div>
	<div class="footer" id="footer">
	</div>	
</body>
<?php }} $_SESSION['expire'] = time() + $time; //update session expiration time. ?>