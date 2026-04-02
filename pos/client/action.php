<!DOCTYPE html>
<html>
  
<head>
    <title>Insert Page page</title>
</head>
  
<body>
    <center>
        <?php
		require '../conn.php';
        
        $conn = new mysqli($servername, $username, $password,$db);
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
        $stmt = $conn->prepare("INSERT IGNORE INTO client VALUES (DEFAULT,?,?,?)");
		$stmt->bind_param("sss",$name, $phone, $email);//sss stands for 3 string parameters only
        //
        $n_in =  $_REQUEST['name'];
        $p_in = $_REQUEST['phone'];
		$e_in = $_REQUEST['email'];
         
		
		$name =  filter_var($n_in, FILTER_SANITIZE_STRING);
        $phone = filter_var($p_in, FILTER_SANITIZE_NUMBER_INT);
		$email = filter_var($e_in, FILTER_SANITIZE_EMAIL);
		$stmt->execute();
		
		
          
        /* $sql = "INSERT IGNORE INTO client VALUES (DEFAULT,'$name','$phone','$email')";
		if(mysqli_query($conn, $sql)){
            echo "<h3>Data stored successfully." 
                . " Please browse your admin page" 
                . " to view the updated data</h3>"; 
  
            echo nl2br("..");
			
        } else{
            echo "ERROR: Sorry $sql. " 
                . mysqli_error($conn);
        } */
          
        // Close connection
		header("location:index.php");
		$stmt->close();
        $conn->close();
        ?>
    </center>
</body>
  
</html>