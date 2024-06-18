<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Nav1.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

	<section>
		<nav>
		<div class="menu-bar">
			<img src="../Images/symbol.jpg" alt="Logo" align="left" class="himg">
			<ul>
				<li class="active"><a href="Home.php">Home</a></li>
				
				<li><a href="#">View</a>
					<div class="sub1">
						<ul>
							<li><a href="Task.php">One Time Task</a></li>
						</ul>
					</div>
				</li>

				<li><a href="self.php">Self Task</a></li>

				<li><a href="#">Settings</a>
					<div class = "sub1">
						<ul>
							<li><a href="change_ip.php">Change ID/Pass</a></li>
							<li><a href="change_email.php">Change Email</a></li>
						</ul>
					</div>
				</li>

				<li><a href="../Admin_login.php">Logout</a></li>
			</ul>
		</div>
		</nav>
	</section>

	<?php 



$conn = mysqli_connect("localhost","root","","task manager");
session_start();
$admin_id = $_SESSION['log_id'];
$temp_result = $conn -> query("SELECT * FROM staff WHERE log_id='$admin_id'") or die($conn -> error());
$temp_row = $temp_result -> fetch_array();
$admin_name = $temp_row['Name'];

$sql_task = "SELECT * FROM tasks WHERE From1='$admin_name' OR To2='$admin_name'";
$result = $conn->query($sql_task);

$sql_task_comp = "SELECT * FROM tasks WHERE state='comp' AND (From1='$admin_name' OR To2='$admin_name')";
$result_comp = $conn->query($sql_task_comp);

$sql_task_nc = "SELECT * FROM tasks WHERE state='Not' AND (From1='$admin_name' OR To2='$admin_name')";
$result_nc = $conn->query($sql_task_nc);

$tot_task = 0;
$tot_comp_task = 0;

$imed_tot_task = 0;
$urgt_tot_task = 0;
$impt_tot_task = 0;
$reg_tot_task = 0;
$expr_tot_task = 0;

$imed_comp_task = 0;
$urgt_comp_task = 0;
$impt_comp_task = 0;
$reg_comp_task = 0;
$expr_comp_task = 0;

$imed_nc_task = 0;
$urgt_nc_task = 0;
$impt_nc_task = 0;
$reg_nc_task = 0;
$expr_nc_task = 0;

//----------------------------------------------------------------------------------------------------task
if($result->num_rows>0)
{

	

  while ($row_task = $result->fetch_assoc())
  {

    $now_task = time(); // or your date as well
		$last_date_task = strtotime($row_task['Ends']);
		$datediff_task = $last_date_task - $now_task;

		$diff_task = round(($datediff_task / (60 * 60 * 24))+1);

    	if($diff_task == 0)
    	{
    		$imed_tot_task++;
    	}
    	elseif($diff_task == 1)
    	{
    		$urgt_tot_task++;
    	}
    	elseif ($diff_task == 2) 
    	{
    		$impt_tot_task++;
    	}
    	elseif($diff_task > 2)
    	{
    		$reg_tot_task++;
    	}

    	$tot_task++;
  }
}

//--------------------------------------------------------------------------------------------task comp
$comp_t = 0;

if($result_comp->num_rows>0)
{
	
	while ($row_comp_task = $result_comp->fetch_assoc())
  {

    $now_comp_task = time(); // or your date as well
		$last_date_comp_task = strtotime($row_comp_task['Ends']);
		$datediff_comp_task = $last_date_comp_task - $now_comp_task;

		$diff_comp = round(($datediff_comp_task / (60 * 60 * 24))+1);

    	if($diff_comp == 0)
    	{
    		$imed_comp_task++;
    	}
    	elseif($diff_comp == 1)
    	{
    		$urgt_comp_task++;
    	}
    	elseif ($diff_comp == 2) 
    	{
    		$impt_comp_task++;
    	}
    	elseif($diff_comp > 2)
    	{
    		$reg_comp_task++;
    	}
    	
    	$comp_t++;

  }
}

//------------------------------------------------------------------------------------------task nc
if($result_nc->num_rows>0)
{
	while ($row_nc_task = $result_nc->fetch_assoc())
  {

    $now_nc_task = time(); // or your date as well
		$last_date_nc_task = strtotime($row_nc_task['Ends']);
		$datediff_nc_task = $last_date_nc_task - $now_nc_task;
		$nc_task = $row_nc_task['State'];

		$diff_nc = round(($datediff_nc_task / (60 * 60 * 24))+1);

    	if($diff_nc == 0)
    	{
    		$imed_nc_task++;
    	}
    	elseif($diff_nc == 1)
    	{
    		$urgt_nc_task++;
    	}
    	elseif ($diff_nc == 2) 
    	{
    		$impt_nc_task++;
    	}
    	elseif($diff_nc > 2)
    	{
    		$reg_nc_task++;
    	}
    	else
    	{
    		$expr_tot_task++ ;
    	}

  }
}

	$tot = $tot_task;
	$comp = $comp_t;

	$imed_tot = $imed_tot_task;
	$urgt_tot = $urgt_tot_task;
	$impt_tot = $impt_tot_task;
	$reg_tot = $reg_tot_task;
	$expr_tot = $expr_tot_task;

	$imed_comp = $imed_comp_task;
	$urgt_comp = $urgt_comp_task;
	$impt_comp = $impt_comp_task;
	$reg_comp = $reg_comp_task;

	$imed_nc = $imed_nc_task;
	$urgt_nc = $urgt_nc_task;
	$impt_nc = $impt_nc_task;
	$reg_nc = $reg_nc_task;



	 ?>

<div class='heading' align="center"><h1 align="center"> Knowledge Institute Of Technology </h1>
	<p align="center" class="quote"> ... Your bright future begins with knowledge ... </p>
	
</div>

<div class="form_out">
<div class="form1">
<ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Today Expires : </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $imed_nc; ?>/<?php echo $imed_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Tomorrow Expires : </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $urgt_nc; ?>/<?php echo $urgt_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">3rd day Expires : </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $impt_nc; ?>/<?php echo $impt_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">	
    <div class="ms-2 me-auto">
      <div class="fw-bold">Regular waiting : </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $reg_nc; ?>/<?php echo $reg_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Total Expired : </div>
     
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $expr_tot; ?>/<?php echo $tot; ?></span>
  </li>
</ol>
</div>

<div class="form2">
<ol class="list-group list-group-numbered">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Today's Completion : </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $imed_comp; ?>/<?php echo $imed_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">2nd day Completion: </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $urgt_comp; ?>/<?php echo $urgt_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">3rd day Completion : </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $impt_comp; ?>/<?php echo $impt_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">	
    <div class="ms-2 me-auto">
      <div class="fw-bold">Regular Completion : </div>
      
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $reg_comp; ?>/<?php echo $reg_tot; ?></span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Total Completion : </div>
     
    </div>
    <span class="badge bg-primary rounded-pill"><?php echo $comp; ?>/<?php echo $tot; ?></span>
  </li>
</ol>
</div>
</div>



</body>
</html>