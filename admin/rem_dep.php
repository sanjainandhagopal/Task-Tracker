<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="../CSS/data_form(css).css">
	<link rel="stylesheet" type="text/css" href="../CSS/home(css).css">
</head>
<body>
	<?php require 'Add_dep(process).php'; ?>

	<div class="form">
	<form method="POST" action="Add_dep(process).php">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Name of the department :</label>
		<input type='text' name='Dept' value="<?php echo $Dept; ?>" placeholder='Enter the department name...'><br>
		<label>Name of the HOD :</label>
		<input type='text' name='Name' value="<?php echo $Name; ?>" placeholder='Enter the name...'><br>
		<label>ID for Department admin :</label>
		<input type='text' name='log_id' value="<?php echo $log_id; ?>" placeholder='Enter the ID...'><br>
		<label>Password for the ID :</label>
		<input type="password" name="pass" value="<?php echo $pass; ?>" id="myInput" placeholder="Enter the password..."><br>
		<input type="checkbox" onclick="myFunction()"><label>Show Password</label><br> <br>

		<script>
			function myFunction() {
  			var x = document.getElementById("myInput");
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

		<button type="submit" name="update">Save Changes</button>
		
	</form>
	</div>
</body>
</html>