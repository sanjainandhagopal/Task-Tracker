<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
</head>

<body>
<a href="Home.php" class="Back" color="red">Return</a>
	<div class="form">
	<form method="POST" action="">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Name of the department : (Ex: IT,AIDS,MECH,CIVIL,ETC...)</label>
		<input type='text' name='Dept' id="department" placeholder='Enter the department name...' required><br>
		<label>Name of the HOD :</label>
		<input type='text' name='Name' id="user" placeholder='Enter the name...' required><br>
		<label>ID for Department admin :</label>
		<input type='text' name='log_id' id="id" placeholder='Enter the ID...' required><br>
		<label>Password for the ID :</label>
		<input type="password" name="pass" id="password" placeholder="Enter the password..." required><br>
		<input type="checkbox" onclick="myFunction()"><label>Show Password</label><br> <br>

		<script>
			function myFunction() {
  			var x = document.getElementById("password");
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

	if (isset($_POST['save']))
	{
		$check_result = $mysqli -> query("SELECT * FROM hod") or die($mysqli -> error());
		$x = 0;

		$Name = mysqli_real_escape_string($mysqli,$_POST['Name']);
		$Dept = mysqli_real_escape_string($mysqli,$_POST['Dept']);
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
  				else if($check_row['Dept'] == $_POST['Dept'])
  				{
  					$x = 2;
  				}
  				else if($check_row['log_id'] == $_POST['log_id'])
  				{
  					$x = 3;
  				}

  			}
		}

		if($x == 1)
		{
			echo "<script>
                	alert('This HOD Name already exist. Please use different one.');
                </script>";
		}
		else if($x == 2)
		{
			echo "<script>
                	alert('This Department already exist. Please use different one.');
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
			$mysqli -> query("INSERT INTO HOD(Name,Dept,log_id,pass) values('$Name','$Dept','$log_id','$pass')");

			header("location:show_dep.php");
		}

	}


	 ?>


</body>
</html>