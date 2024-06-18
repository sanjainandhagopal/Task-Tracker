<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Task viewer</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Nav1.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/tablecol.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Btn.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<script src="../JS/script.js"></script>
</head>

<body>

<style>
	body
	{
		font-family:Arial;
	}
	.dow-btn
	{
		background-color: #1741bf;
		color:white;
		height: 35px;
		width: 60px;
		border-radius: 10px;
		position:absolute;
		top:20px;
		right:50px;
		
	}
	.dow-btn:hover 
	{
		cursor:pointer;
		background-color:#112d80;
	}
	form
	{
		height:0px;
		width:0px;
	}

	input
	{
		width:100%;
	}
</style>

	<section>
		<nav>
		<div class="menu-bar">
			<img src="../Images/symbol.jpg" alt="Logo" align="left" class="nimg">
			<ul>
				<li class="active"><a href="Home.php">Home</a></li>
				<li><a href="select.php">Add new</a></li>
				<li><a href="../Admin_login.php">Logout</a></li>
				<li><form action="pdf_gen.php" method="POST">
						<button type="submit" name="btn-pdf" class="dow-btn">PDF</button>
					</form></li>
			</ul>
		</div>
		</nav>
	</section>

	<div class="table-container">
		<table class="table sticky" id="myTable">
			
			<thead>

				<tr id="header">
					<th class="table-cell">Task No</th>
					<th class="table-cell">Task ID</th>
					<th class="table-cell" colspan="2">From</th>
					<th class="table-cell" colspan="2">Assign To</th>
					<th class="table-cell">Task</th>			
					<th class="table-cell">Begins</th>
					<th class="table-cell">Deadline</th>
					<th class="table-cell">Status</th>
					<th class="table-cell">Remarks</th>
					<th class="table-cell">Re-assign</th>
					<th class="table-cell">Completion</th>
					<th class="table-cell">Action</th>
				</tr>
				
			</thead>

			<tbody>

				<?php 

					$conn = mysqli_connect("localhost","root","","task manager");

					session_start();
					$admin_id = $_SESSION['log_id'];
					$temp_result = $conn -> query("SELECT * FROM hod WHERE log_id='$admin_id'") or die($conn -> error());
					$temp_row = $temp_result -> fetch_array();
					$admin_name = $temp_row['Name'];

					$Today = time();
					$Today = date('Y-m-d',strtotime($Today));

					$sql = "SELECT * FROM tasks WHERE From1='$admin_name' OR To2='$admin_name'";
					$sql2 = "SELECT * FROM tasks WHERE From1='$admin_name' AND Begins=CURDATE() ORDER BY ID DESC";
					$sql_comp = "SELECT * FROM tasks WHERE State='comp' AND (From1='$admin_name' OR To2='$admin_name')";
					$result_tod = $conn->query($sql2);
					$result_imd = $conn->query($sql);
					$result_urg = $conn->query($sql);
					$result_imp = $conn->query($sql);
					$result_reg = $conn->query($sql);
					$result_exp = $conn->query($sql);
					$result_comp = $conn->query($sql_comp);
					$No = 0;

				?>

				<?php

			if($result_tod->num_rows>0)
			{

                        while ($row_tod = $result_tod->fetch_assoc())
                        {
                        	
                        	if($row_tod['State'] != 'comp')
                        	{
					$F_date = date('d-m-Y',strtotime($row_tod["Begins"]));
					$Dead_Line = date('d-m-Y',strtotime($row_tod["Ends"]));
                                	$edate=$row_tod['Ends'];

                                	$now = time(); // or your date as well
					$last_date = strtotime($row_tod['Ends']);
					$datediff = $last_date - $now;

					$diff = round(($datediff / (60 * 60 * 24))+1);

					$tod = "Today assigned";

                                
                                
                                	$No = $No+1;
                                	if($No%2 == 0)
                                	{
                                		echo "<tr class='even_row'><td>".$No."</td><td>".$row_tod["ID"]."</td><td>".$row_tod["From1"]."</td><td>".$row_tod["Role1"].$row_tod["Dep1"]."</td><td>".$row_tod["To2"]."</td><td>".$row_tod["Role2"].$row_tod["Dep2"]."</td><td>".$row_tod["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='tod'>".$tod."</td><td>".$row_tod["Remarks"]."</td>";
                                	}
                                	else
                                	{
                                		echo "<tr class='odd_row'><td>".$No."</td><td>".$row_tod["ID"]."</td><td>".$row_tod["From1"]."</td><td>".$row_tod["Role1"].$row_tod["Dep1"]."</td><td>".$row_tod["To2"]."</td><td>".$row_tod["Role2"].$row_tod["Dep2"]."</td><td>".$row_tod["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='tod'>".$tod."</td><td>".$row_tod["Remarks"]."</td>";
                                	}
                ?>
                			<td>
                			<?php
                    				if($row_tod['Role2'] != 'HOD')
                				{ ?>
                    					<button class="re"><a href="re-assign.php?Re-assign=<?php echo $row_tod['ID']; ?>">Re-assign</a></button>
                    					<?php } ?>
                    			</td>
                			

		                	<?php
                    			if($row_tod['State'] == 'Not')
                			{ ?>
                    				<td><button class="comp"><a href="process.php?State=<?php echo $row_tod['ID']; ?>">Complete</a></button></td>
                    			<?php }
                    			elseif($row_tod['State'] == 'comp')
                    			{ ?>
                    				<td><button class="undo"><a href="process.php?undo=<?php echo $row_tod['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    			else
                    			{ ?>
                    				<td><button class="comp"><a href="process.php?acces=<?php echo $row_tod['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                    			<td>
                    			<div>
                    				<?php
                    				if($row_tod['Role2'] == 'HOD')
                				{ ?>
                    					<button class="ed">You won't</button>
                    			<?php 	}
                    				elseif($row_tod['Role2'] != 'HOD' && $row_tod['Dep2'] = " ")
                    				{ ?>
                    					<button class="ed"><a href="Admin_get.php?edit=<?php echo $row_tod['ID']; ?>">Edit</a></button>
                    			<?php }
                    				else
                    				{ ?>
                    					<button class="ed"><a href="Staff_get.php?edit=<?php echo $row_tod['ID']; ?>">Edit</a></button>
                    			<?php } ?>
                    			</div>
                    			<div>
                    				<?php
                    				if($row_tod['Role2'] != 'HOD')
                				{ ?>
                    					<button class="del"><a href="process.php?delete=<?php echo $row_tod['ID']; ?>">Delete</a></button>
                    					<?php } ?>
                    					
                    				</div> 								
                    				</td>   	 			
	 								</tr>
                <?php
                                
                        	}
                        }
					}

				 ?>

				<?php

					if($result_imd->num_rows>0)
					{

                        while ($row_imd = $result_imd->fetch_assoc())
                        {
                        	if($row_imd['State'] != 'comp')
                        	{
								$F_date = date('d-m-Y',strtotime($row_imd["Begins"]));
								$Dead_Line = date('d-m-Y',strtotime($row_imd["Ends"]));
                                $edate=$row_imd['Ends'];

                                $now = time(); // or your date as well
								$last_date = strtotime($row_imd['Ends']);
								$datediff = $last_date - $now;

								$diff = round(($datediff / (60 * 60 * 24))+1);

								$imd = "Immediate";

                                if($diff == 0)
                                {
                                	$No = $No+1;
                                	if($No%2 == 0)
                                	{
                                		echo "<tr class='even_row'><td>".$No."</td><td>".$row_imd["ID"]."</td><td>".$row_imd["From1"]."</td><td>".$row_imd["Role1"].$row_imd["Dep1"]."</td><td>".$row_imd["To2"]."</td><td>".$row_imd["Role2"].$row_imd["Dep2"]."</td><td>".$row_imd["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='imd'>".$imd."</td><td>".$row_imd["Remarks"]."</td>";
                                	}
                                	else
                                	{
                                		echo "<tr class='odd_row'><td>".$No."</td><td>".$row_imd["ID"]."</td><td>".$row_imd["From1"]."</td><td>".$row_imd["Role1"].$row_imd["Dep1"]."</td><td>".$row_imd["To2"]."</td><td>".$row_imd["Role2"].$row_imd["Dep2"]."</td><td>".$row_imd["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='imd'>".$imd."</td><td>".$row_imd["Remarks"]."</td>";
                                	}
                ?>

                					<td>
                			<?php
                    				if($row_imd['Role2'] != 'HOD')
                				{ ?>
                    					<button class="re"><a href="re-assign.php?Re-assign=<?php echo $row_imd['ID']; ?>">Re-assign</a></button>
                    					<?php } ?>
                    			</td>

		                			<?php
                    				if($row_imd['State'] == 'Not')
                					{ ?>
                    					<td><button class="comp"><a href="process.php?State=<?php echo $row_imd['ID']; ?>">Complete</a></button></td>
                    			<?php }
                    				elseif($row_imd['State'] == 'comp')
                    				{ ?>
                    					<td><button class="undo"><a href="process.php?undo=<?php echo $row_imd['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process.php?acces=<?php echo $row_imd['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                    				<td>

                    				<div>
                    					<?php
                    				if($row_imd['Role2'] == 'HOD')
                					{ ?>
                    					<button class="ed">You won't</button>
                    			<?php }
                    				elseif($row_imd['Role2'] != 'HOD' && $row_imd['Dep2'] = " ")
                    				{ ?>
                    					<button class="ed"><a href="Admin_get.php?edit=<?php echo $row_imd['ID']; ?>">Edit</a></button>
                    			<?php }
                    				else
                    				{ ?>
                    					<button class="ed"><a href="Staff_get.php?edit=<?php echo $row_imd['ID']; ?>">Edit</a></button>
                    			<?php } ?>
                    				</div>

                    				<div>
                    					<?php
                    					if($row_imd['Role2'] != 'HOD')
                					{ ?>
                    					<button class="del"><a href="process.php?delete=<?php echo $row_imd['ID']; ?>">Delete</a></button>
                    					<?php } ?>
                    					
                    				</div>
	 								</td>   	 			
	 								</tr>
                <?php
                                }
                        	}
                        }
					}

				 ?>

				 <?php

					if($result_urg->num_rows>0)
					{

                        while ($row_urg = $result_urg->fetch_assoc())
                        {
                        	if($row_urg['State'] != 'comp')
                        	{
								$F_date = date('d-m-Y',strtotime($row_urg["Begins"]));
								$Dead_Line = date('d-m-Y',strtotime($row_urg["Ends"]));
                                $edate=$row_urg['Ends'];

                                $now = time(); // or your date as well
								$last_date = strtotime($row_urg['Ends']);
								$datediff = $last_date - $now;

								$diff = round(($datediff / (60 * 60 * 24))+1);

								$urg = "Urgent";

                                if($diff == 1)
                                {
                                	$No = $No+1;
                                	if($No%2 == 0)
                                	{
                                		echo "<tr class='even_row'><td>".$No."</td><td>".$row_urg["ID"]."</td><td>".$row_urg["From1"]."</td><td>".$row_urg["Role1"].$row_urg["Dep1"]."</td><td>".$row_urg["To2"]."</td><td>".$row_urg["Role2"].$row_urg["Dep2"]."</td><td>".$row_urg["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='urg'>".$urg."</td><td>".$row_urg["Remarks"]."</td>";
                                	}
                                	else
                                	{
                                		echo "<tr class='odd_row'><td>".$No."</td><td>".$row_urg["ID"]."</td><td>".$row_urg["From1"]."</td><td>".$row_urg["Role1"].$row_urg["Dep1"]."</td><td>".$row_urg["To2"]."</td><td>".$row_urg["Role2"].$row_urg["Dep2"]."</td><td>".$row_urg["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='urg'>".$urg."</td><td>".$row_urg["Remarks"]."</td>";
                                	}
                ?>

                					<td>
                			<?php
                    				if($row_urg['Role2'] != 'HOD')
                				{ ?>
                    					<button class="re"><a href="re-assign.php?Re-assign=<?php echo $row_urg['ID']; ?>">Re-assign</a></button>
                    					<?php } ?>
                    			</td>

		                			<?php
                    				if($row_urg['State'] == 'Not')
                					{ ?>
                    					<td><button class="comp"><a href="process.php?State=<?php echo $row_urg['ID']; ?>">Complete</a></button></td>
                    			<?php }
                    				elseif($row_urg['State'] == 'comp')
                    				{ ?>
                    					<td><button class="undo"><a href="process.php?undo=<?php echo $row_urg['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process.php?acces=<?php echo $row_urg['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                    				<td>
                    				<div>
                    					<?php
                    				if($row_urg['Role2'] == 'HOD')
                					{ ?>
                    					<button class="ed">You won't</button>
                    			<?php }
                    				elseif($row_urg['Role2'] != 'HOD' && $row_urg['Dep2'] = " ")
                    				{ ?>
                    					<button class="ed"><a href="Admin_get.php?edit=<?php echo $row_urg['ID']; ?>">Edit</a></button>
                    			<?php }
                    				else
                    				{ ?>
                    					<button class="ed"><a href="Staff_get.php?edit=<?php echo $row_urg['ID']; ?>">Edit</a></button>
                    			<?php } ?>
                    				</div>
                    				<div>
                    					<?php
                    					if($row_urg['Role2'] != 'HOD')
                					{ ?>
                    					<button class="del"><a href="process.php?delete=<?php echo $row_urg['ID']; ?>">Delete</a></button>
                    					<?php } ?>
                    					
                    				</div> 								
                    				</td>   	 			
	 								</tr>
                <?php
                                }
                        	}
                        }
					}

				 ?>

				 <?php

					if($result_imp->num_rows>0)
					{

                        while ($row_imp = $result_imp->fetch_assoc())
                        {
                        	if($row_imp['State'] != 'comp')
                        	{
								$F_date = date('d-m-Y',strtotime($row_imp["Begins"]));
								$Dead_Line = date('d-m-Y',strtotime($row_imp["Ends"]));
                                $edate=$row_imp['Ends'];

                                $now = time(); // or your date as well
								$last_date = strtotime($row_imp['Ends']);
								$datediff = $last_date - $now;

								$diff = round(($datediff / (60 * 60 * 24))+1);

								$imp = "Important";

                                if($diff == 2)
                                {
                                	$No = $No+1;
                                	if($No%2 == 0)
                                	{
                                		echo "<tr class='even_row'><td>".$No."</td><td>".$row_imp["ID"]."</td><td>".$row_imp["From1"]."</td><td>".$row_imp["Role1"].$row_imp["Dep1"]."</td><td>".$row_imp["To2"]."</td><td>".$row_imp["Role2"].$row_imp["Dep2"]."</td><td>".$row_imp["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='imp'>".$imp."</td><td>".$row_imp["Remarks"]."</td>";
                                	}
                                	else
                                	{
                                		echo "<tr class='odd_row'><td>".$No."</td><td>".$row_imp["ID"]."</td><td>".$row_imp["From1"]."</td><td>".$row_imp["Role1"].$row_imp["Dep1"]."</td><td>".$row_imp["To2"]."</td><td>".$row_imp["Role2"].$row_imp["Dep2"]."</td><td>".$row_imp["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='imp'>".$imp."</td><td>".$row_imp["Remarks"]."</td>";
                                	}
                ?>

                					<td>
                			<?php
                    				if($row_imp['Role2'] != 'HOD')
                				{ ?>
                    					<button class="re"><a href="re-assign.php?Re-assign=<?php echo $row_imp['ID']; ?>">Re-assign</a></button>
                    					<?php } ?>
                    			</td>

		                			<?php
                    				if($row_imp['State'] == 'Not')
                					{ ?>
                    					<td><button class="comp"><a href="process.php?State=<?php echo $row_imp['ID']; ?>">Complete</a></button></td>
                    			<?php }
                    				elseif($row_imp['State'] == 'comp')
                    				{ ?>
                    					<td><button class="undo"><a href="process.php?undo=<?php echo $row_imp['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process.php?acces=<?php echo $row_imp['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                    				<td>
                    				<div>
                    					<?php
                    				if($row_imp['Role2'] == 'HOD')
                					{ ?>
                    					<button class="ed">You won't</button>
                    			<?php }
                    				elseif($row_imp['Role2'] != 'HOD' && $row_imp['Dep2'] = " ")
                    				{ ?>
                    					<button class="ed"><a href="Admin_get.php?edit=<?php echo $row_imp['ID']; ?>">Edit</a></button>
                    			<?php }
                    				else
                    				{ ?>
                    					<button class="ed"><a href="Staff_get.php?edit=<?php echo $row_imp['ID']; ?>">Edit</a></button>
                    			<?php } ?>
                    				</div>
                    				<div>
                    					<?php
                    					if($row_imp['Role2'] != 'HOD')
                					{ ?>
                    					<button class="del"><a href="process.php?delete=<?php echo $row_imp['ID']; ?>">Delete</a></button>
                    					<?php } ?>
                    					
                    				</div>
	 								</td>   	 			
	 								</tr>
                <?php
                                }
                        	}
                        }
					}

				 ?>

				 <?php

					if($result_reg->num_rows>0)
					{

                        while ($row_reg = $result_reg->fetch_assoc())
                        {
                        	if($row_reg['State'] != 'comp')
                        	{
								$F_date = date('d-m-Y',strtotime($row_reg["Begins"]));
								$Dead_Line = date('d-m-Y',strtotime($row_reg["Ends"]));
                                $edate=$row_reg['Ends'];

                                $now = time(); // or your date as well
								$last_date = strtotime($row_reg['Ends']);
								$datediff = $last_date - $now;

								$diff = round(($datediff / (60 * 60 * 24))+1);

								$reg = "Regular";

                                if($diff > 2)
                                {
                                	$No = $No+1;
                                	if($No%2 == 0)
                                	{
                                		echo "<tr class='even_row'><td>".$No."</td><td>".$row_reg["ID"]."</td><td>".$row_reg["From1"]."</td><td>".$row_reg["Role1"].$row_reg["Dep1"]."</td><td>".$row_reg["To2"]."</td><td>".$row_reg["Role2"].$row_reg["Dep2"]."</td><td>".$row_reg["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='reg'>".$reg."</td><td>".$row_reg["Remarks"]."</td>";
                                	}
                                	else
                                	{
                                		echo "<tr class='odd_row'><td>".$No."</td><td>".$row_reg["ID"]."</td><td>".$row_reg["From1"]."</td><td>".$row_reg["Role1"].$row_reg["Dep1"]."</td><td>".$row_reg["To2"]."</td><td>".$row_reg["Role2"].$row_reg["Dep2"]."</td><td>".$row_reg["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='reg'>".$reg."</td><td>".$row_reg["Remarks"]."</td>";
                                	}
                ?>

                					<td>
                			<?php
                    				if($row_reg['Role2'] != 'HOD')
                				{ ?>
                    					<button class="re"><a href="re-assign.php?Re-assign=<?php echo $row_reg['ID']; ?>">Re-assign</a></button>
                    					<?php } ?>
                    			</td>

		                			<?php
                    				if($row_reg['State'] == 'Not')
                					{ ?>
                    					<td><button class="comp"><a href="process.php?State=<?php echo $row_reg['ID']; ?>">Complete</a></button></td>
                    			<?php }
                    				elseif($row_reg['State'] == 'comp')
                    				{ ?>
                    					<td><button class="undo"><a href="process.php?undo=<?php echo $row_reg['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process.php?acces=<?php echo $row_reg['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                    				<td>
                    				<div>
                    					<?php
                    				if($row_reg['Role2'] == 'HOD')
                					{ ?>
                    					<button class="ed">You won't</button>
                    			<?php }
                    				elseif($row_reg['Role2'] != 'HOD' && $row_reg['Dep2'] = " ")
                    				{ ?>
                    					<button class="ed"><a href="Admin_get.php?edit=<?php echo $row_reg['ID']; ?>">Edit</a></button>
                    			<?php }
                    				else
                    				{ ?>
                    					<button class="ed"><a href="Staff_get.php?edit=<?php echo $row_reg['ID']; ?>">Edit</a></button>
                    			<?php } ?>
                    				</div>
                    				<div>
                    					<?php
                    					if($row_reg['Role2'] != 'HOD')
                					{ ?>
                    					<button class="del"><a href="process.php?delete=<?php echo $row_reg['ID']; ?>">Delete</a></button>
                    					<?php } ?>
                    					
                    				</div>
	 								</td>   	 			
	 								</tr>
                <?php
                                }
                        	}
                        }
					}

				 ?>

				 <?php

					if($result_exp->num_rows>0)
					{

                        while ($row_exp = $result_exp->fetch_assoc())
                        {
                        	if($row_exp['State'] != 'comp')
                        	{
								$F_date = date('d-m-Y',strtotime($row_exp["Begins"]));
								$Dead_Line = date('d-m-Y',strtotime($row_exp["Ends"]));
                                $edate=$row_exp['Ends'];

                                $now = time(); // or your date as well
								$last_date = strtotime($row_exp['Ends']);
								$datediff = $last_date - $now;

								$diff = round(($datediff / (60 * 60 * 24))+1);

								$exp = "Expired";

                                if($diff < 0)
                                {
                                	$No = $No+1;
                                	if($No%2 == 0)
                                	{
                                		echo "<tr class='even_row'><td>".$No."</td><td>".$row_exp["ID"]."</td><td>".$row_exp["From1"]."</td><td>".$row_exp["Role1"].$row_exp["Dep1"]."</td><td>".$row_exp["To2"]."</td><td>".$row_exp["Role2"].$row_exp["Dep2"]."</td><td>".$row_exp["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='exp'>".$exp."</td><td>".$row_exp["Remarks"]."</td>";
                                	}
                                	else
                                	{
                                		echo "<tr class='odd_row'><td>".$No."</td><td>".$row_exp["ID"]."</td><td>".$row_exp["From1"]."</td><td>".$row_exp["Role1"].$row_exp["Dep1"]."</td><td>".$row_exp["To2"]."</td><td>".$row_exp["Role2"].$row_exp["Dep2"]."</td><td>".$row_exp["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='exp'>".$exp."</td><td>".$row_exp["Remarks"]."</td>";
                                	}
                ?>

                					<td>
                			<?php
                    				if($row_exp['Role2'] != 'HOD')
                				{ ?>
                    					<button class="re"><a href="re-assign.php?Re-assign=<?php echo $row_exp['ID']; ?>">Re-assign</a></button>
                    					<?php } ?>
                    			</td>

		                			<?php
                    				if($row_exp['State'] == 'Not')
                					{ ?>
                    					<td><button class="comp"><a href="process.php?State=<?php echo $row_exp['ID']; ?>">Complete</a></button></td>
                    			<?php }
                    				elseif($row_exp['State'] == 'comp')
                    				{ ?>
                    					<td><button class="undo"><a href="process.php?undo=<?php echo $row_exp['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process.php?acces=<?php echo $row_exp['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                    				<td>
                    				<div>
                    					<?php
                    				if($row_exp['Role2'] == 'HOD')
                					{ ?>
                    					<button class="ed">You won't</button>
                    			<?php }
                    				elseif($row_exp['Role2'] != 'HOD' && $row_exp['Dep2'] = " ")
                    				{ ?>
                    					<button class="ed"><a href="Admin_get.php?edit=<?php echo $row_exp['ID']; ?>">Edit</a></button>
                    			<?php }
                    				else
                    				{ ?>
                    					<button class="ed"><a href="Staff_get.php?edit=<?php echo $row_exp['ID']; ?>">Edit</a></button>
                    			<?php } ?>
                    				</div>
                    				<div>
                    					<?php
                    					if($row_exp['Role2'] != 'HOD')
                					{ ?>
                    					<button class="del"><a href="process.php?delete=<?php echo $row_exp['ID']; ?>">Delete</a></button>
                    					<?php } ?>
                    					
                    				</div>
	 								</td>   	 			
	 								</tr>
                <?php
                                }
                        	}
                        }
					}

				 ?>

				 <?php

					if($result_comp->num_rows>0)
					{

                        while ($row_comp = $result_comp->fetch_assoc())
                        {
                        	$F_date = date('d-m-Y',strtotime($row_comp["Begins"]));
								$Dead_Line = date('d-m-Y',strtotime($row_comp["Ends"]));
                                $edate=$row_comp['Ends'];

                                $now = time(); // or your date as well
								$last_date = strtotime($row_comp['Ends']);
								$datediff = $last_date - $now;

								$diff = round(($datediff / (60 * 60 * 24))+1);

								$comp = "Completed";

                                
                                	$No = $No+1;
                                	if($No%2 == 0)
                                	{
                                		echo "<tr class='even_row'><td>".$No."</td><td>".$row_comp["ID"]."</td><td>".$row_comp["From1"]."</td><td>".$row_comp["Role1"].$row_comp["Dep1"]."</td><td>".$row_comp["To2"]."</td><td>".$row_comp["Role2"].$row_comp["Dep2"]."</td><td>".$row_comp["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='comp'>".$comp."</td><td>".$row_comp["Remarks"]."</td>";
                                	}
                                	else
                                	{
                                		echo "<tr class='odd_row'><td>".$No."</td><td>".$row_comp["ID"]."</td><td>".$row_comp["From1"]."</td><td>".$row_comp["Role1"].$row_comp["Dep1"]."</td><td>".$row_comp["To2"]."</td><td>".$row_comp["Role2"].$row_comp["Dep2"]."</td><td>".$row_comp["Task"]."</td><td>".$F_date."</td><td>".$Dead_Line."</td><td class='comp'>".$comp."</td><td>".$row_comp["Remarks"]."</td>";
                                	}
                ?>

                					<td>
                			<?php
                    				if($row_comp['Role2'] != 'HOD')
                				{ ?>
                    					<button class="re"><a href="re-assign.php?Re-assign=<?php echo $row_comp['ID']; ?>">Re-assign</a></button>
                    					<?php } ?>
                    			</td>

		                			<?php
                    				if($row_comp['State'] == 'Not')
                					{ ?>
                    					<td><button class="comp"><a href="process.php?State=<?php echo $row_comp['ID']; ?>">Complete</a></button></td>
                    			<?php }
                    				elseif($row_comp['State'] == 'comp')
                    				{ ?>
                    					<td><button class="undo"><a href="process.php?undo=<?php echo $row_comp['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process.php?acces=<?php echo $row_comp['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                    				<td>
                    				<div>
                    					<?php
                    				if($row_comp['Role2'] == 'HOD')
                					{ ?>
                    					<button class="ed">You won't</button>
                    			<?php }
                    				elseif($row_comp['Role2'] != 'HOD' && $row_comp['Dep2'] = " ")
                    				{ ?>
                    					<button class="ed"><a href="Admin_get.php?edit=<?php echo $row_comp['ID']; ?>">Edit</a></button>
                    			<?php }
                    				else
                    				{ ?>
                    					<button class="ed"><a href="Staff_get.php?edit=<?php echo $row_comp['ID']; ?>">Edit</a></button>
                    			<?php } ?>
                    				</div>
                    				<div>
                    					<?php
                    					if($row_comp['Role2'] != 'HOD')
                					{ ?>
                    					<button class="del"><a href="process.php?delete=<?php echo $row_comp['ID']; ?>">Delete</a></button>
                    					<?php } ?>
                    					
                    				</div>
	 								</td>   	 			
	 								</tr>
								
                <?php
                             
                        	
                        }
					}

				 ?>
				
			</tbody>

		</table>
	</div>

</body>

<footer align="center">

	<input type="text" id="From_inp" onkeyup="From()" placeholder="Search by from" title="Who Assigns">
	<input type="text" id="To_inp" onkeyup="To()" placeholder="Search by Assign to" title="Whos task">
	<input type="text" id="Task_inp" onkeyup="Task()" placeholder="Search by Task" title="Task">
	<input type="text" id="deadline_inp" onkeyup="deadline()" placeholder="Search by Deadline" title="When">
	<input type="text" id="Stat_inp" onkeyup="status()" placeholder="Search by Status" title="Who Assigns">

</footer>

</html>