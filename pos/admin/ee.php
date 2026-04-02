<script src="../tablesorter/jquery.tablesorter.min.js"></script>

<!DOCTYPE html>
<head>
	<title>POS ADMIN</title>
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
	$(function(){
      $("#navbar").load("navbar.html"); 
    });
	$(function(){
      $("#footer").load("footer.html"); 
    });
	$('#parent').on('click', 'button[name=sort]', function(){

		$(this).attr('name','sort');
		$(this).text('ID &darr;');

	});

	$('#parent').on('click', 'button[name=get]', function(){

		$(this).attr('name','post');
		$(this).text('post');

	});
	</script>
	<script>
	function deviceType(id){
		switch (id){
			case 0:
				return "Other";
			case 1: 
				return "Phone";
			case 2: 
				return "Tablet";
			case 3: 
				return "Computer";
			default:
				return "ERR-DT FUNC";
		}
	}
	</script>
	<script src="sorting.js"></script>
</head>
<body>
	<div class="navigation" id="navbar">	
	</div>
	<div class="content">
	<form action="?">
		<input type="hidden" name="sort" value='<?php if(isset($_GET['sort'])) {echo $_GET['sort'];} ?>'>
		<input type="hidden"name="order" value="<?php if(isset($_GET['order'])) {echo $_GET['order'];} ?>">
		<input type="text" name="search" placeholder="Enter Query:">
		Filter by:
		<select name="filter">
			<option value="name">Name</option>
			<option value="time_start">Time Started</option>
			<option value="time_end">Time Ended</option>
			<option value="email">Email</option>
			<option value="phone">Phone</option>
			<option value="service">Service Required</option>
			<option value="notes">Notes</option>
		</select>
		<input type="submit" value="Search">
	</form>
	<table>
		<tr id="legend">
			<th><a id="id" href="">  ID  </button></th> 
			<th><a id="time_start" href="">  Time Started  </a></th>
			<th><a id="time_end" href="">  Time Ended </a></th>
			<th><a id="name" href="">  Name  </a></th>
			<th><a id="email" href="">  Email  </a></th>
			<th><a id="phone" href="">  Phone  </a></th>
			<th><a id="type" href="">  Device Type  </a></th>
			<th><a id="service" href="">  Service Required  </a></th>
			<th><a id="notes" href="">  Notes </a></th>
			<th>  Edit </th>
			<th>  Delete </th>
		</tr> 
	<?php
		require '../conn.php';
		$find = "";
		$sort = "";
		if (count($_GET) > 1) {
			$order = $_GET['order'];
			$search = "";
			$filter = "";
			if (isset($_GET['search']))
				$search = $_GET['search'];
			if (isset($_GET['filter']))
				$filter = $_GET['filter'];
			
			if ($search != "")
				$find = " WHERE ".$filter." LIKE '%".$search."%'";
			$sort = " ORDER BY invoice.".$_GET['sort']." ".$order;	
			
		}
		$sql = "select * from invoice".$find.$sort;
		//echo "select * from invoice".$find.$sort;
		$result = $conn->query($sql);

		
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc() ){
			//echo "<tr> <td>".$row["id"]. "</td> <td>". $row["time_start"] . "</td> <td>".$row["time_end"]. "</td> <td>".$row["name"]. "</td> <td>".$row["contact"]. "</td><td>".$row["type"]. "</td> <td>".$row["service"]. "</td> <td>".$row["notes"]. "</td> <td><a href='edit.php?id=".$row["id"]."'><img src='edit.png'></td> <td><a href='delete.php?id=".$row["id"]."'><img src='del.png'></td></tr>";
				echo "<tr>";
				echo "<td>".$row["id"]. "</td>";
				echo "<td>". $row["time_start"] . "</td>";
				echo "<td>".$row["time_end"]. "</td>";
				echo "<td>".$row["name"]. "</td>";
				echo "<td>".$row["email"]. "</td>";
				echo "<td>".$row["phone"]. "</td>";
				echo "<td>";
				echo "<script>";
				echo "document.write(deviceType(".$row["type"]."));";
				echo "</script>";
				echo "</td>";
				echo "<td>".$row["service"]. "</td>";
				echo "<td>".$row["notes"]. "</td>";
				echo "<td><a href='edit.php?id=".$row["id"]."'><img src='edit.png'></td>";
				echo "<td><a href='delete.php?id=".$row["id"]."'><img src='del.png'></td></tr>";
				echo "</tr>";
			}
		} else {
			echo "0 records";
		}

		$conn->close();
	?>
	</table>
	</div>
	<div class="footer" id="footer">
	</div>	
</body>