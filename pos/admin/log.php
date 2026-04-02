<?php
date_default_timezone_set('America/Los_Angeles');


$log_in = "[".date('h:i:s')."] : " . $log . " : USER:".$_SESSION['user'];
$log_path = "../logs/log-".date('Y-m-d').".txt";
$log_file = fopen($log_path, "a+");
fwrite($log_file, "\n\n" . $log_in);

?>