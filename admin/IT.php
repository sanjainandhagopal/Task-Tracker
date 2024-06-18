<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Singlton Task</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
</head>
<body>
<a href="Home.php" class="Back" color="red">Return</a>
	

	<?php require 'process.php'; ?>

	<div class="form">
	<form method="POST" action="process_staff.php">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Task :</label>
		<input type="text" name="Task" value="<?php echo $Task; ?>" placeholder="What is the task"><br>

		<label>Assign To :</label><br>
		<select name="Assign_To" id="subject">
			<option value="" selected="selected">Who's task is this</option>

    		<?php 

    			$conn = mysqli_connect("localhost","root","","task manager");
				$sql = "SELECT * FROM staff  WHERE Dept='IT'";
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