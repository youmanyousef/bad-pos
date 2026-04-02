<?php

require '../conn.php';
//echo "Connected successfully";
$stmt = $conn_users->prepare("SELECT connected FROM users");
$stmt->execute();
$stopper = "F";
foreach ($stmt->get_result() as $row) {
	if ($row['connected'] == 1) {
		$stopper = "T";
		break;
	}
}
if ($stopper == "T") {
?>
<!DOCTYPE html>
<head>
	<title>POS CLIENT</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<img id="logo" src="../images/logo.png">
	<form action="action.php">
		<label for="name"><h1>Name: </h1></label>
		<input type="text" id="name" name="name">
		<label for="email"><h1>Email: </h1></label>
		<input type="text" id="contact" name="email">
		<label for="contact"><h1>Phone: </h1></label>
		<input type="text" id="contact" name="phone">
		<input type="submit" value="Confirm">
	</form>
</body>
<?php 
}else{
	echo "<style> 
		.done {
			height: 10em;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: Verdana,Geneva,sans-serif; 
			font-size: 72px;
			margin: 0;
		}
	
	</style>";
	echo "<p class='done'>The service desk is empty. Please wait.</p>";
}
?>
