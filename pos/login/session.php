<?php
require 'conn.php';

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
<html>
	<head>
		
		
	</head>
	<body>
		Welcome <?php echo $_SESSION['user']; ?>.
		Your session time is <?php echo time() - $_SESSION['start']; ?> seconds.
		<?php 
			echo "<a href='logout.php'>Log out</a>";
		?>
	</body>
</html>
		
<?php }} $_SESSION['expire'] = time() + $time; //update session expiration time. ?>