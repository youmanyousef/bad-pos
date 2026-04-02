<link rel="stylesheet" href="./css/style.css">
<body>
	<div class="content">
		<?php
			require '../conn.php';
			$date = date('Y-m-d');
			$sql = "SELECT * FROM `invoice` WHERE time_end LIKE '%".$date."%'";
			$result = $conn->query($sql);
			echo "Today you have to finish these orders:<br>";
			
			
			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc() ){
				//echo "<tr> <td>".$row["id"]. "</td> <td>". $row["time_start"] . "</td> <td>".$row["time_end"]. "</td> <td>".$row["name"]. "</td> <td>".$row["contact"]. "</td><td>".$row["type"]. "</td> <td>".$row["service"]. "</td> <td>".$row["notes"]. "</td> <td><a href='edit.php?id=".$row["id"]."'><img src='edit.png'></td> <td><a href='delete.php?id=".$row["id"]."'><img src='del.png'></td></tr>";
					
					echo "<table>";
					echo "<tr>";
					echo $row["name"] . ", ";
					echo $row["email"] . ", " ;
					echo $row["phone"] . ", ";
					echo $row["service"] . ".";
					echo "</tr>";
					echo "</table>";
				}
			} else {
				echo "<tr><td>There arent any orders for today!</td></tr>";
			}
			
		?>
	</div>
</body>
