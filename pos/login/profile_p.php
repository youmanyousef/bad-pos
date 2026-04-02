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