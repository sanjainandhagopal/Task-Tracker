<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="../CSS/data_form(css).css">
	<link rel="stylesheet" type="text/css" href="../CSS/home(css).css">
</head>

<?php 

$id = 0;
$update = false;
$Name = '';
$Dept = '';
$log_id= '';
$pass= '';

 ?>
<body>

	<div class="form">
	<form method="POST" action="">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Name of the department :</label>
		<input type='text' name='Dept' value="<?php echo $Dept; ?>" id="department" placeholder='Enter the department name...' required><br>
		<label>Name of the HOD :</label>
		<input type='text' name='Name' value="<?php echo $Name; ?>" id="user" placeholder='Enter the name...' required><br>
		<label>ID for Department admin :</label>
		<input type='text' name='log_id' value="<?php echo $log_id; ?>" id="id" placeholder='Enter the ID...' required><br>
		<label>Password for the ID :</label>
		<input type="password" name="pass" value="<?php echo $pass; ?>" id="password" placeholder="Enter the password..." required><br>
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

		

		<?php if ($update == true): ?>

			<button type="submit" name="update">Save Changes</button>
			
		<?php else: ?>

			<button type="submit" name="save">Save</button>

		<?php endif; ?>
		
	</form>
	</div>

	<?php 
	$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));

	if (isset($_POST['save']))
	{

		$Name = mysqli_real_escape_string($mysqli,$_POST['Name']);
		$Dept = mysqli_real_escape_string($mysqli,$_POST['Dept']);
		$log_id = $_POST['log_id'];
		$pass = $_POST['pass'];

		$mysqli -> query("INSERT INTO HOD(Name,Dept,log_id,pass) values('$Name','$Dept','$log_id','$pass')");

	}


	 ?>


</body>
</html>