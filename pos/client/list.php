<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "customers";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
$sql = "select * from invoice";
$result = $conn->query($sql);

echo "<table> <tr> <th> id </th>  <th>  time_start  </th> <th> time_end </th> <th>  name  </th><th>  contact  </th><th>  type  </th> <th>  service  </th><th>  notes </th> </tr> ";
if ($result->num_rows > 0){
while($row = $result->fetch_assoc() ){
 echo "<tr> <td>".$row["id"]. "</td> <td>". $row["time_start"] . "</td> <td>".$row["time_end"]. "</td> <td>".$row["name"]. "</td> <td>".$row["contact"]. "</td><td>".$row["type"]. "</td> <td>".$row["service"]. "</td> <td>".$row["notes"]. "</td></tr>";
}
} else {
 echo "0 records";
}
echo "</table>";

$conn->close();

?>
<style>
table{border-style: solid;border-color: black; background-color: grey;}
tr{background-color: white}
td{background-color: white}
</style>