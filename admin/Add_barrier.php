<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="data_form(css).css">
</head>
<body>
	<?php require 'Add_barrier(process).php'; ?>

	<div class="form">
	<form method="POST" action="Add_bar(process).php">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Name of the staff :</label>
		<input type='text' name='Name' value="<?php echo $staff_name; ?>" placeholder='Enter the staff name...'><br>
		<label>Role of the staff :</label>
		<input type='text' name='Role' value="<?php echo $staff_role; ?>" placeholder='Enter the staff name...'><br>
		<label>ID for staff :</label>
		<input type='text' name='staff_id' value="<?php echo $staff_id; ?>" placeholder='Enter the staff ID...'><br>
		<label>Password for the ID :</label>
		<input type="password" name="password" value="<?php echo $password; ?>" id="myInput" placeholder="Enter the password..."><br>
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

		<?php if ($update == true): ?>

			<a href="show_bar.php"><button type="submit" name="update">Save Changes</button></a>
			
		<?php else: ?>

			<a href="show_bar.php"><button type="submit" name="save">Save</button></a>

		<?php endif; ?>
		
	</form>
	</div>
</body>
</html>