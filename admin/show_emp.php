<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Department Data</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Nav.css">
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
							<li><a href="select.php">One Time Task</a></li>
							<li><a href="O_get_data.php">Yearly Once Event</a></li>
							<li><a href="T_get_data.php">Half yearly Event</a></li>
						</ul>
					</div>
				</li>

				<li><a href="#">View</a>
					<div class="sub1">
						<ul>
							<li><a href="Task.php">One Time Task</a></li>
							<li><a href="once.php">Yearly Events</a></li>
							<li><a href="twice.php">Half-Yearly Events</a></li>
						</ul>
					</div>
				</li>

				<li><a href="Add_emp.php">Add new Administrator</a></li>
				<li><a href="../Admin_login.php">Logout</a></li>
			</ul>
		</div>
		</nav>
	</section>

	<table class="table sticky">
		
		<thead>
		<tr id="header">
			<th class="table-cell">S.No.</th>			
			<th class="table-cell">Name</th>
			<th class="table-cell">Role</th>
			<th class="table-cell">ID</th>
			<th class="table-cell">Password</th>
			<th class="table-cell">Edit</th>
			<th class="table-cell">Remove</th>	
			<th class="table-cell">Administrator</th>		
		</tr>
		</thead>

		<tbody>
		<?php
			$conn = mysqli_connect("localhost","root","","task manager");
			$sql = "SELECT * FROM administrator WHERE NOT ID=1";
			$result = $conn->query($sql);

			if($result->num_rows>0)	
			{	
				$No = 0;
				while ($row = $result->fetch_assoc()) {

					$No = $No+1;

					if($No%2 == 0)
					{
						echo "<tr class='even_row'><td>".$No."</td><td>".$row["Name"]."</td><td>".$row["Role"]."</td><td>".$row["log_id"]."</td><td>".$row["pss"]."</td>";
					}
					else
					{
						echo "<tr class='odd_row'><td>".$No."</td><td>".$row["Name"]."</td><td>".$row["Role"]."</td><td>".$row["log_id"]."</td><td>".$row["pss"]."</td>";
					}

			 ?>

					<td><button class="re"><a href="rem_emp.php?Change=<?php echo $row['ID']; ?>">Change</a></button></td>
					<td><button class="del"><a href="rem_emp(process).php?Remove=<?php echo $row['ID']; ?>">Remove</a></button></td>

					<?php
                    if($row['control'] == 1)
                	{ ?>
                    	<td><button class="del"><a href="rem_emp(process).php?No=<?php echo $row['ID']; ?>">NO</a></button></td>
                    <?php }
                    elseif($row['control'] == 0)
                    { ?>
                    	<td><button class="re"><a href="rem_emp(process).php?Yes=<?php echo $row['ID']; ?>">YES</a></button></td>
                    <?php } ?>

		<?php 
				}
			}  

			$conn->close(); ?>

</body>
</html>