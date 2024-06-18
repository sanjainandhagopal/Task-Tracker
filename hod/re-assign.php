<!DOCTYPE html>
<html>
<head>
	<title>Re-Assign</title>
	<link rel="stylesheet" type="text/css" href="../CSS/data_form(css).css">
	<link rel="stylesheet" type="text/css" href="../CSS/home(css).css">
</head>
<body>

	<?php require 'process.php'; ?>

	<div class="form">
		<form method="POST" action="process.php">
			<input type="hidden" name="ID" value="<?php echo $ID; ?>">
			
			<label>Re assign the Task:</label>

			<input type="date" name="Dead_Line" value="<?php echo $Dead_Line; ?>"><br>

			<button type="submit" name="re-assign">Assign</button>
		</form>
	</div>

</body>
</html>