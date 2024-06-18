<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Singlton Task</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<a href="Home.php" class="Back" color="red">Return</a>
	<?php
		$conn = mysqli_connect("localhost","root","","task manager");
		session_start();
		$admin_id = $_SESSION['log_id'];
		$temp_result = $conn -> query("SELECT * FROM hod WHERE log_id='$admin_id'") or die($conn -> error());
		$temp_row = $temp_result -> fetch_array();
		$admin_name = $temp_row['Dept']; 

	?>

	<?php require 'process_staff.php'; ?>

	<div class="form">
	<form method="POST" action="process_staff.php">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Task :</label>
		<input type="text" name="Task" value="<?php echo $Task; ?>" placeholder="What is the task"><br>

		<label>Assign To :</label><br>
		<select name="Assign_To" id="subject">
			<option value="" selected="selected">Who's task is this</option>
			<option value="staff">To Everyone</option>
			<option value="self">To Self</option>

    		<?php 

				$sql = "SELECT * FROM staff  WHERE Dept = '$admin_name'";
				$result = $conn->query($sql);
				$list1 = [];
				$num = 0;
				
				if($result->num_rows>0)
				{
					while ($row = $result->fetch_assoc()) 
					{
						
							$list1[$num] = $row['Name'];
							$list2[$num] = $row['Role2'];
							$list3[$num] = $row['Dept'];
							$num++;
						
					}
				}

				$list1 =$list1;
				$list2 = $list2;
				
				$num1 = sizeof($list1);

				for($i = 0;$i<$num1;$i++)
				{ ?>
					<option value="<?php echo $list1[$i]; ?>"><?php echo $list1[$i]; ?></option>
				<?php } ?>
				
  		</select><br>

		<label>Dead Line :</label>
		<input type="date" name="Dead_Line" value="<?php echo $Dead_Line; ?>"><br>
		<label>Remarks :</label>
		<input type="text" name="Remarks" value="<?php echo $Remarks; ?>" placeholder="Enter any remarks here"><br>

		<?php if ($update == true): ?>

			<button type="submit" name="update">Save Changes</button>
			
		<?php else: ?>

			<button type="submit" name="save">Save</button>

		<?php endif; ?>

		</div>
		
	</form>

	<script type="text/javascript">
		$(document).ready(function(){
			$('input[type="radio"]').click(function(){
				var inputvalue = $(this).attr("value");
				var targetbox = $("."+inputvalue);
				$(".box").not(targetbox).hode();
				$(targetbox).show();
			});
		});
	</script>

</body>
</html>