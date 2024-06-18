<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
</head>
<body>
<a href="Home.php" class="Back" color="red">Return</a>
	<?php require 'O_Process.php'; ?>

	<form method="POST" action="O_Process.php">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>This can view by other administrators.</label><br><br>
		<label>Date :</label>
		<input type="date" name="Date" value="<?php echo $Date; ?>" placeholder="Enter the date of an event"><br>
		<label>Event :</label>
		<input type="text" name="Event" value="<?php echo $Event; ?>" placeholder="Enter an event"><br>
		<label>End of Event : (Optional)</label>
		<input type="date" name="E_event" value="<?php echo $E_event; ?>" placeholder="When event gets over"><br>
		<label>Remarks :</label>
		<input type="text" name="Remarks" value="<?php echo $Remarks; ?>" placeholder="Enter your remarks here"><br>

		<?php if ($update == true): ?>

			<button type="submit" name="update">Save Changes</button>
			
		<?php else: ?>

			<button type="submit" name="save">Save</button>

		<?php endif; ?>
		
	</form>

</body>
</html>