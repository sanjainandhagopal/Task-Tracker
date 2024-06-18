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

		<label>Name of the Administrator :</label>
		<input type='text' name='Name' placeholder='Enter the administrator name...' required><br>
		<label>Role of the Administrator :</label>
		<input type='text' name='Role' placeholder='Enter the Role...' required><br>
		<label>ID for Administrator :</label>
		<input type='text' name='log_id' placeholder='Enter the ID...' required><br>
		<label>Password for the ID :</label>
		<input type="password" name="pss" id="pss" placeholder="Enter the password..." required><br>
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

	if (isset($_POST['save']))
	{
		$check_result = $mysqli -> query("SELECT * FROM administrator") or die($mysqli -> error());
		$x = 0;

		$Name = mysqli_real_escape_string($mysqli,$_POST['Name']);
		$Role = mysqli_real_escape_string($mysqli,$_POST['Role']);
		$log_id = mysqli_real_escape_string($mysqli,$_POST['log_id']);
		$pss = mysqli_real_escape_string($mysqli,$_POST['pss']);

		if($check_result->num_rows>0)
		{
			while ($check_row = $check_result->fetch_assoc())
  			{
  				if($check_row['Name'] == $_POST['Name'])
  				{
  					$x = 1;
  				}
  				else if($check_row['Role'] == $_POST['Role'])
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
                	alert('This Admin Name already exist. Please use different one.');
                </script>";
		}
		else if($x == 2)
		{
			echo "<script>
                	alert('This Role already exist. Please use different one.');
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
			$mysqli -> query("INSERT INTO administrator(Name,Role,log_id,pss) values('$Name','$Role','$log_id','$pss')");

			header("location:show_emp.php");
		}

	}


	 ?>


	 ?>


</body>
</html>