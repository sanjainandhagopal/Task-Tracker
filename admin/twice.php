<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Half-Yearly Events</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Nav.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/tablecol.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Btn.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
</head>
<body>
	<section>
		<nav>
		<div class="menu-bar">
			<img src="../Images/symbol.jpg" alt="Logo" align="left" class="nimg">
			<ul>
				<li class="active"><a href="Home.php">Home</a></li>
				<li><a href="T_get_data.php">Add new</a></li>
				<li><a href="#">View</a>
					<div class="sub1">
						<ul>
							<li><a href="Task.php">One Time Task</a></li>
							<li><a href="once.php">Yearly Events</a></li>
						</ul>
					</div>
				</li>
				<li><a href="../Admin_login.php">Logout</a></li>
			</ul>
		</div>
		</nav>
	</section>

	<div>
	<table class="table sticky">
		
		<thead>
		<tr id="header">
			<th class="table-cell">Event No.</th>			
			<th class="table-cell">Event Starts</th>
			<th class="table-cell">Event</th>
			<th class="table-cell">Event Restarts</th>
			<th class="table-cell">Status</th>
			<th class="table-cell">Remarks</th>
			<th class="table-cell">Action</th>
			
		</tr>
		</thead>
		

		<tbody>
		<?php
			$conn = mysqli_connect("localhost","root","","task manager");
			$sql = "SELECT * FROM y_t_event";
			$result = $conn->query($sql);

			if($result->num_rows>0)	
			{
                            $cdate=date("d-m");
                            $No = 0;
				while ($row = $result->fetch_assoc()) {

					$No = $No+1;
					$t_date = date('d-m',strtotime($row["Date"]));
					$r_date = date('d-m',strtotime($row["R_date"]));

					if($No%2 == 0)
					{
						echo "<tr class='even_row'><td>".$No."</td><td>".$t_date."</td><td>".$row["Event"]."</td><td>".$r_date."</td>";
					}
					else
					{
						echo "<tr class='odd_row'><td>".$No."</td><td>".$t_date."</td><td>".$row["Event"]."</td><td>".$r_date."</td>";
					}
		                              
		                     $sdate=$row['Date'];
                                   $edate=$row['R_date'];

                                   $curr_date = strtotime($cdate);
                                   $start_date = date('d-m',strtotime($row['Date']));
                                   $end_date = date('d-m',strtotime($row['R_date']));

                                   if($curr_date<$start_date)
                                   {
                                          echo "<td>Not yet Started</td>";
                                   }
                                   elseif ($curr_date>$start_date && $curr_date<$end_date) {
                                   	echo "<td>Event will restart soon<td>";
                                   }
                              	elseif ($curr_date==$start_date)
                                   {
                                    	echo "<td><font color='darkgreen'>Frist Half Started</td>";
                                   }
                                   elseif ($curr_date==$end_date)
                                   {
                                         	echo "<td><font color='red'>Second Time Event Started</td>";
                                   }
                                  	elseif($curr_date>$end_date)
                                   {
                                          echo "<td><font color='gray'>Both Events are completed</td>";
                                   }
                                   else
                                   {
                                   	echo "<td><font color='yellow'>Event completed</td>";
                                   }

                                   echo "<td>".$row["Remarks"]."</td>"; ?>

                    		<td>
	 			<button class="ed"><a href="T_get_data.php?edit=<?php echo $row['ID']; ?>">Edit</a></button>
	 			<button class="del"><a href="T_Process.php?delete=<?php echo $row['ID']; ?>">Delete</a></button>
	 			</td>   

                     <?php	}
			}
			else
			{
				echo "No Events are available";
			}
			$conn->close();
		?>
		</tbody>
	</table>
	

</body>
</html>