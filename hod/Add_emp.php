<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
</head>

<body>
<a href="Home.php" class="Back" color="red">Return</a>
	<div class="form">
	<form method="POST" action="">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Name of the Staff :</label>
		<input type='text' name='Name' placeholder='Enter the administrator name...' required><br>
		<label>Primitive Role : (If they had any administrative role.)</label>
		<input type='text' name='Role' placeholder='(Ex: NSS Coordinator)'><br>
		<label>ID for Staff :</label>
		<input type='text' name='log_id' placeholder='Enter the ID...' required><br>
		<label>Password for the ID :</label>
		<input type="password" name="pass" id="pss" placeholder="Enter the password..." required><br>
		<input type="checkbox" onclick="myFunction()"><label>Show Password</label><br> <br>

		<script>
			function myFunction() {
  			var x = document.getElementById("pss");
  			if (x.type === "password") 
  			{
    			x.type = "text";
  			} 
  			else 
  			{
    			x.type = "password";
  			}
			}
		</script>

		<button type="submit" name="save">Save</button>
		
	</form>
	</div>

	<?php 
	$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));

	session_start();
	$admin_id = $_SESSION['log_id'];
	$temp_result = $mysqli -> query("SELECT * FROM hod WHERE log_id='$admin_id'") or die($conn -> error());
	$temp_row = $temp_result -> fetch_array();
	$admin_name = $temp_row['Dept'];

	if (isset($_POST['save']))
	{
		$check_result = $mysqli -> query("SELECT * FROM staff WHERE Dept='$admin_name'") or die($mysqli -> error());
		$check_result1 = $mysqli -> query("SELECT * FROM staff") or die($mysqli -> error());
		$x = 0;

		$Name = mysqli_real_escape_string($mysqli,$_POST['Name']);
		$Role = mysqli_real_escape_string($mysqli,$_POST['Role']);
		$log_id = mysqli_real_escape_string($mysqli,$_POST['log_id']);
		$pass = mysqli_real_escape_string($mysqli,$_POST['pass']);

		if($check_result->num_rows>0)
		{
			while ($check_row = $check_result->fetch_assoc())
  			{
  				if($check_row['Name'] == $_POST['Name'])
  				{
  					$x = 1;
  				}

  			}
		}

		if($check_result1->num_rows>0)
		{
			while ($check_row1 = $check_result1->fetch_assoc())
  			{
  				if($check_row1['log_id'] == $_POST['log_id'])
  				{
  					$x = 3;
  				}
  			}
		}

		if($x == 1)
		{
			echo "<script>
                	alert('This Name already exist. Please use different one.');
                </script>";
		}
		else if($x == 3)
		{
			echo "<script>
                	alert('This ID already exist. Please use different one.');
                </script>";	
		}
		else
		{
			$mysqli -> query("INSERT INTO staff(Name,Role2,Dept,log_id,pass) values('$Name','$Role','$admin_name','$log_id','$pass')");

			header("location:show_dep.php");
		}

	}


	 ?>


</body>
</html>