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
		$dir = '../export';
		$args = count($_GET);
		/*if (!(empty($_GET))) {
			if ($_GET['year'] != null) {
				$year = $_GET['year'];
				$dir = '../export/'.$year;
				if ($args > 1) {
					$month = $_GET['month'];
					$dir = '../export/'.$year.'/'.$month.'';
				}
			}
		}*/
		if (isset($_GET['year'])) {
			$year = $_GET['year'];
			$dir = '../export/'.$year;
			if (isset($_GET['month'])) { 
				$month = $_GET['month'];
				$dir = '../export/'.$year.'/'.$month.'';
			}
		}

		$fs = array_diff(scandir($dir, SCANDIR_SORT_NONE),array('..','.'));
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
		
		<ul class='dir'>
			<?php 
				foreach($fs as $key => $value){
					//echo "<li><a href='' name='".$value."' value='".$value."'>".$value."</a></li>";
					echo "<form action='?'>";
					if ((int)$value != null){
						echo "<button id='dir_btn' type='submit' name='year' value='".$value."'>".$value;
						echo "</button>";
					}
					else {
						if (isset($_GET['year']) and isset($_GET['month'])) {
							echo "<a id='dir_btn' href='".$dir.'/'.$value."'>".$value."</a>";
						}
						else{
							echo "<input type='hidden' name='year' value='".$year."'>";
							echo "<button id='dir_btn' type='submit' name='month' value='".$value."'>".$value;
							echo "</button>";
						}
						
					}
					echo "<br>";
					echo "</form>";
				}
				//echo $dir."<br>";
				//echo print_r($fs);
			?>
		<ul>
		
	</div>
	<div class="footer" id="footer">
	</div>	
</body>
<?php }} $_SESSION['expire'] = time() + $time; //update session expiration time. ?>