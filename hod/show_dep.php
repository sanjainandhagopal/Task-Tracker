<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Department Data</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Nav1.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/tablecol.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Btn.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
</head>
<body>

	<section>
		<nav>
		<div class="menu-bar">
			<img src="../Images/symbol.jpg" alt="Logo" align="left" class="himg">
			<ul>
				<li class="active"><a href="Home.php">Home</a></li>

				<li><a href="#">Add new</a>
					<div class="sub1">
						<ul>
							<li><a href="Data_get.php">One Time Task</a></li>
						</ul>
					</div>
				</li>

				<li><a href="#">View</a>
					<div class="sub1">
						<ul>
							<li><a href="Task.php">One Time Task</a></li>
						</ul>
					</div>
				</li>

				<li><a href="Add_emp.php">Add new Staff</a></li>
				<li><a href="../Admin_login.php">Logout</a></li>
			</ul>
		</div>
		</nav>
	</section>

	<table class="table sticky">
		
		<thead>
		<tr id="header">
			<th class="table-cell">S.No.</th>			
			<th class="table-cell">Staff Name</th>
			<th class="table-cell">S&H</th>
			<th class="table-cell">ID</th>
			<th class="table-cell">Password</th>
			<th class="table-cell">Edit</th>
			<th class="table-cell">Remove</th>			
		</tr>
		</thead>

		<tbody>
		<?php
			$conn = mysqli_connect("localhost","root","","task manager");

			session_start();
			$admin_id = $_SESSION['log_id'];
			$temp_result = $conn -> query("SELECT * FROM hod WHERE log_id='$admin_id'") or die($conn -> error());
			$temp_row = $temp_result -> fetch_array();
			$admin_name = $temp_row['Dept'];

			$sql = "SELECT * FROM staff WHERE Dept='$admin_name'";
			$result = $conn->query($sql);

			if($result->num_rows>0)	
			{	
				$No = 0;
				while ($row = $result->fetch_assoc()) {

					$No = $No+1;

					if($No%2 == 0)
					{
						echo "<tr class='even_row'><td>".$No."</td><td>".$row["Name"]."</td><td>".$row["Role2"]."</td><td>".$row["log_id"]."</td><td>".$row["pass"]."</td>";
					}
					else
					{
						echo "<tr class='odd_row'><td>".$No."</td><td>".$row["Name"]."</td><td>".$row["Role2"]."</td><td>".$row["log_id"]."</td><td>".$row["pass"]."</td>";
					}

			 ?>

					<td><button class="re"><a href="rem_dep.php?Change=<?php echo $row['ID']; ?>">Change</a></td>
					<td></button><button class="del"><a href="Add_dep(process).php?Remove=<?php echo $row['ID']; ?>">Remove</a></button></td></tr>

		<?php 
				}
			}  

			$conn->close(); ?>

</body>
</html>