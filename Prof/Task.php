<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task viewer</title>
        <link rel="stylesheet" type="text/css" href="../CSS1/Nav.css">
        <link rel="stylesheet" type="text/css" href="../CSS1/tablecol.css">
        <link rel="stylesheet" type="text/css" href="../CSS1/Btn.css">
        <link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
        <script src="VU/JS/script.js"></script>
    </head>

    <Body>
        <style>
            body
            {
                font-family:Arial;
            }
            .t_width
            {
                width:50px;
            }

            #t_width
            {
                width:50px;
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
                        <li><a href="#">View</a>
                            <div class="sub1">
                                <ul>
                                    <li><a href="once.php">Yearly Events</a></li>
                                    <li><a href="twice.php">Half-Yearly Events</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="../Admin_login.php">Logout</a></li>
                        <li><form action="pdf_gen.php" method="POST">
                                <button type="submit" name="btn-pdf" class="dow-btn">PDF</button>
                            </form></li>	
                    </ul>
                </div>
                </nav>
            </section>

            <div class="container">
                <table class="table" id="myTable">
                    
                    <thead>

                        <tr id="header">
                            <th class="table-cell">Task No</th>
                            <th class="table-cell">ID</th>
                            <th class="table-cell" colspan="2">From</th>
                            <th class="table-cell" colspan="2">Assign To</th>
                            <th class="table-cell" id="t_width" width='50px'>Task</th>			
                            <th class="table-cell">Begins</th>
                            <th class="table-cell">Deadline</th>
                            <th class="table-cell">Status</th>
                            <th class="table-cell">Remarks</th>
                            <th class="table-cell">Completion</th>
                            <th class="table-cell">Action</th>
                        </tr>
                        
                    </thead>

                    <tbody>
                        <?php 
                        
                        $conn = mysqli_connect("localhost","root","","task manager");
                        session_start();
                        $admin_id = $_SESSION['log_id'];
                        $temp_result = $conn -> query("SELECT * FROM staff WHERE log_id='$admin_id'") or die($conn -> error());
                        $temp_row = $temp_result -> fetch_array();
                        $admin_name = $temp_row['Name'];

                        $query = "SELECT * FROM tasks WHERE From1='$admin_name' OR To2='$admin_name' ORDER BY Ends";
                        $data = $conn->query($query);

                        $expir = "SELECT * FROM tasks WHERE From1='$admin_name' OR To2='$admin_name' ORDER BY Ends Asc";
                        $ex_data = $conn->query($expir);

                        $complete = "SELECT * FROM tasks WHERE From1='$admin_name' OR To2='$admin_name' ORDER BY Ends";
                        $com_data = $conn->query($complete);

                        $today = "SELECT * FROM tasks WHERE From1='$admin_name' AND Begins=CURDATE() ORDER BY date1 DESC";
                        $tod_data = $conn->query($today);

                        $sno = 0;

                        if($tod_data->num_rows>0)
                        {
                            while($row = $tod_data->fetch_assoc())
                            {
                                $date1 = date('d-m-Y h:m:s',strtotime($row["date1"]));
                                $date2 = date('d-m-Y',strtotime($row["Ends"]));
                                $sno += 1;
                                
                                if($row['State'] != 'comp')
                                {
                                    
                                    if($sno%2 == 0)
                                    {
                                        $cls = "even_row";
                                    }
                                    else
                                    {
                                        $cls = "odd_row";
                                    }

                                    echo "<tr class='$cls'><td>".$sno."</td><td>".$row["ID"]."</td><td>".$row["From1"]."</td><td>".$row["Role1"].$row["Dep1"]."</td><td>".$row["To2"]."</td><td>".$row["Role2"].$row["Dep2"]."</td><td class='t_width' width='50px'>".$row["Task"]."</td><td>".$date1."</td><td>".$date2."</td>";
                                    
                                    $status = "Today Assigned";

                                    echo "<td>".$status."</td><td>".$row["Remarks"]."</td>"; 
									
									
                    				if($row['State'] == 'Not' && $row['To2'] == 'Self')
                					{ ?>
                    					<td><button class="comp"><a href="process_self.php?State=<?php echo $row['ID']; ?>">Complete</a></button></td>
                    			<?php }
									else if($row['State'] == 'Not' && $row['To2'] != 'Self')
									{ ?>
										<td><button class="comp"><a href="process_self.php?req=<?php echo $row['ID']; ?>">Request</a></button></td>
								<?php }
                    				else if($row['State'] == 'request')
                    				{ ?>
                    					<td><button class="undo"><a href="process_self.php?undo=<?php echo $row['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process_self.php?acces=<?php echo $row['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                                <td>
                    				<div>
                    					<?php
                    				if($row['To2'] == 'Self')
                					{ ?>
                    					<button class="ed"><a href="self.php?edit=<?php echo $row['ID']; ?>">Edit</a></button>

                    				</div>
                    				<div>
                    					<button class="del"><a href="process_self.php?delete=<?php echo $row['ID']; ?>">Delete</a></button>
										<?php } ?>
                    				</div>
	 								</td>   	 			
	 								</tr>
                            <?php    }
                            }
                        }

                        if($data->num_rows>0)
                        {
                            while($row = $data->fetch_assoc())
                            {
                                $date1 = date('d-m-Y h:m:s',strtotime($row["date1"]));
                                $date2 = date('d-m-Y',strtotime($row["Ends"]));

                                $now = time(); // or your date as well
                                $last_date = strtotime($row['Ends']);
                                $datediff = $last_date - $now;

                                $diff = round(($datediff / (60 * 60 * 24))+1);
                                
                                if($row['State'] != 'comp' && $diff >= 0)
                                {
                                    $sno += 1;
                                    
                                    if($sno%2 == 0)
                                    {
                                        $cls = "even_row";
                                    }
                                    else
                                    {
                                        $cls = "odd_row";
                                    }

                                    echo "<tr class='$cls'><td>".$sno."</td><td>".$row["ID"]."</td><td>".$row["From1"]."</td><td>".$row["Role1"].$row["Dep1"]."</td><td>".$row["To2"]."</td><td>".$row["Role2"].$row["Dep2"]."</td><td class='t_width' width='50px'>".$row["Task"]."</td><td>".$date1."</td><td>".$date2."</td>";
                                    if($diff == 0)
                                    {
                                        $status = "Immediate";
                                        $st_cls = "imd";
                                    }
                                    else if($diff == 1)
                                    {
                                        $status = "Urgent";
                                        $st_cls = "urg";
                                    }
                                    else if($diff == 2)
                                    {
                                        $status = "Important";
                                        $st_cls = "imp";
                                    }
                                    else if($diff > 2)
                                    {
                                        $status = "Regular";
                                        $st_cls = "reg";
                                    }

                                    echo "<td class='$st_cls'>".$status."</td><td>".$row["Remarks"]."</td>";  
									
                    				if($row['State'] == 'Not' && $row['To2'] == 'Self')
                					{ ?>
                    					<td><button class="comp"><a href="process_self.php?State=<?php echo $row['ID']; ?>">Complete</a></button></td>
                    			<?php }
									else if($row['State'] == 'Not' && $row['To2'] != 'Self')
									{ ?>
										<td><button class="comp"><a href="process_self.php?req=<?php echo $row['ID']; ?>">Request</a></button></td>
								<?php }
                    				else if($row['State'] == 'request')
                    				{ ?>
                    					<td><button class="undo"><a href="process_self.php?undo=<?php echo $row['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process_self.php?acces=<?php echo $row['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                                <td>
                    				<div>
                    					<?php
                    				if($row['To2'] == 'Self')
                					{ ?>
                    					<button class="ed"><a href="Hod_get.php?edit=<?php echo $row['ID']; ?>">Edit</a></button>

                    				</div>
                    				<div>
                    					<button class="del"><a href="process_self.php?delete=<?php echo $row['ID']; ?>">Delete</a></button>
										<?php } ?>
                    				</div>
	 								</td>   	 			
	 								</tr>
                            <?php    }
                            }
                        }

                        if($ex_data->num_rows>0)
                        {
                            while($row = $ex_data->fetch_assoc())
                            {
                                $date1 = date('d-m-Y h:m:s',strtotime($row["date1"]));
                                $date2 = date('d-m-Y',strtotime($row["Ends"]));

                                $now = time(); // or your date as well
                                $last_date = strtotime($row['Ends']);
                                $datediff = $last_date - $now;

                                $diff = round(($datediff / (60 * 60 * 24))+1);
                                
                                if($row['State'] != 'comp' && $diff < 0)
                                {
                                    $sno += 1;
                                    
                                    if($sno%2 == 0)
                                    {
                                        $cls = "even_row";
                                    }
                                    else
                                    {
                                        $cls = "odd_row";
                                    }

                                    echo "<tr class='$cls'><td>".$sno."</td><td>".$row["ID"]."</td><td>".$row["From1"]."</td><td>".$row["Role1"].$row["Dep1"]."</td><td>".$row["To2"]."</td><td>".$row["Role2"].$row["Dep2"]."</td><td class='t_width' width='50px'>".$row["Task"]."</td><td>".$date1."</td><td>".$date2."</td>";
                                    if($diff < 0)
                                    {
                                        $status = "Expired";
                                        $st_cls = "exp";
                                    }

                                    echo "<td class='$st_cls'>".$status."</td><td>".$row["Remarks"]."</td>"; 
									
                    				if($row['State'] == 'Not' && $row['To2'] == 'Self')
                					{ ?>
                    					<td><button class="comp"><a href="process_self.php?State=<?php echo $row['ID']; ?>">Complete</a></button></td>
                    			<?php }
									else if($row['State'] == 'Not' && $row['To2'] != 'Self')
									{ ?>
										<td><button class="comp"><a href="process_self.php?req=<?php echo $row['ID']; ?>">Request</a></button></td>
								<?php }
                    				else if($row['State'] == 'request')
                    				{ ?>
                    					<td><button class="undo"><a href="process_self.php?undo=<?php echo $row['ID']; ?>">Undo</a></button></td>
                    			<?php }
                    				else
                    				{ ?>
                    					<td><button class="comp"><a href="process_self.php?acces=<?php echo $row['ID']; ?>">Accept</a></button></td>
                    			<?php } ?>
                                <td>
                    				<div>
                    					<?php
                    				if($row['To2'] == 'Self')
                					{ ?>
                    					<button class="ed"><a href="Hod_get.php?edit=<?php echo $row['ID']; ?>">Edit</a></button>

                    				</div>
                    				<div>
                    					<button class="del"><a href="process_self.php?delete=<?php echo $row['ID']; ?>">Delete</a></button>
										<?php } ?>
                    				</div>
	 								</td>   	 			
	 								</tr>
                            <?php    }
                            }
                        }

                        if($com_data->num_rows>0)
                        {
                            while($row = $com_data->fetch_assoc())
                            {
                                $date1 = date('d-m-Y h:m:s',strtotime($row["date1"]));
                                $date2 = date('d-m-Y',strtotime($row["Ends"]));

                                $now = time(); // or your date as well
                                $last_date = strtotime($row['Ends']);
                                $datediff = $last_date - $now;

                                $diff = round(($datediff / (60 * 60 * 24))+1);
                                
                                if($row['State'] == 'comp')
                                {
                                    $sno += 1;
                                    
                                    if($sno%2 == 0)
                                    {
                                        $cls = "even_row";
                                    }
                                    else
                                    {
                                        $cls = "odd_row";
                                    }

                                    echo "<tr class='$cls'><td>".$sno."</td><td>".$row["ID"]."</td><td>".$row["From1"]."</td><td>".$row["Role1"].$row["Dep1"]."</td><td>".$row["To2"]."</td><td>".$row["Role2"].$row["Dep2"]."</td><td class='t_width' width='50px'>".$row["Task"]."</td><td>".$date1."</td><td>".$date2."</td>";
                                    $status = "Completed";
                                    $st_cls = "complete";

                                    echo "<td class='$st_cls'>".$status."</td><td>".$row["Remarks"]."</td>";  
									
									
                    				if($row['State'] == 'comp' && $row['To2'] == 'Self')
                					{ ?>
                    					<td><button class="undo"><a href="process_self.php?undo=<?php echo $row['ID']; ?>">Undo</a></button></td>
                    			<?php } 
								else{ ?>
										<td>You got Completed</td>
								<?php }
								?>
                                <td>
                    				<div>
                    					<?php
                    				if($row['To2'] == 'Self')
                					{ ?>
                    					<button class="ed"><a href="Hod_get.php?edit=<?php echo $row['ID']; ?>">Edit</a></button>

                    				</div>
                    				<div>
                    					<button class="del"><a href="process_self.php?delete=<?php echo $row['ID']; ?>">Delete</a></button>
										<?php } ?>
                    				</div>
	 								</td>     	 			
	 								</tr>
                            <?php    }
                            }
                        }
                        
                        ?>
                    </tbody>
    </Body>
</html>