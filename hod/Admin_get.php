<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Singlton Task</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
</head>
<body>
<a href="Home.php" class="Back" color="red">Return</a>
	<?php require 'process_admin.php'; ?>

	<div class="form">
	<form method="POST" action="process_admin.php">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Task :</label>
		<input type="text" name="Task" value="<?php echo $Task; ?>" placeholder="What is the task"><br>

		<div id="op1" class="box one">

		<label>Assign To :</label><br>
		<select name="Assign_To" id="subject">
			<option value="" selected="selected">Who's task is this</option>

    		<?php 

    			$conn = mysqli_connect("localhost","root","","task manager");
				$sql = "SELECT * FROM administrator";
				$result = $conn->query($sql);
				$list1 = [];
				$num = 0;
				
				if($result->num_rows>0)
				{
					while ($row = $result->fetch_assoc()) 
					{
						$list1[$num] = $row['Name'];
						$list2[$num] = $row['Role'];
						$num++;
					}
				}

				$list1 = array_values(array_unique($list1));
				$list2 = array_values(array_unique($list2));
				$num1 = sizeof($list1);

				for($i = 0;$i<$num1;$i++)
				{ ?>
					<option value="<?php echo $list1[$i]; ?>"><?php echo $list2[$i].' - '.$list1[$i]; ?></option>
				<?php } ?>
				
  		</select><br>

  		</div>

		<label>Dead Line :</label>
		<input type="date" name="Dead_Line" value="<?php echo $Dead_Line; ?>"><br>
		<label>Remarks :</label>
		<input type="text" name="Remarks" value="<?php echo $Remarks; ?>" placeholder="Enter any remarks here"><br>

		<?php if ($update == true): ?>

			<button type="submit" name="update">Save Changes</button>
			
		<?php else: ?>

			<button type="submit" name="save">Save</button>

		<?php endif; ?>
		
	</form>
	</div>

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