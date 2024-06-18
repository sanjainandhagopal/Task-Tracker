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

<style>
	.selectbox {
		position:relative;
	}

	.selectbox select {
		width: 100%;
	}

	.overselect {
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
	}

	#checkboxes {
		display: none;
	}

</style>

<a href="Home.php" class="Back" color="red">Return</a>

	<?php require 'process.php'; ?>

	<div class="form">
	<form method="POST" action="process.php">

		<input type="hidden" name="ID" value="<?php echo $ID; ?>">

		<label>Task :</label>
		<input type="text" name="Task" value="<?php echo $Task; ?>" placeholder="What is the task"><br>

		<label>Assign To :</label><br>
		<div class="multiselect">
		<div class="selectbox" onclick="showcheckboxes()">
			<select>
				<option>-- Select --</option>
			</select>
			<div class="overselect"></div>
		</div>

		<div id="checkboxes">
		<input type="checkbox" id="checkall">Check all<br>

    		<?php 

    			$conn = mysqli_connect("localhost","root","","task manager");
				$sql = "SELECT * FROM hod";
				$result = $conn->query($sql);
				$list1 = [];
				$num = 0;
				
				if($result->num_rows>0)
				{
					while ($row = $result->fetch_assoc()) 
					{
						$list1[$num] = $row['Name'];
						$list2[$num] = $row['Role'];
						$list3[$num] = $row['Dept'];
						$num++;
					}
				}

				$list1 =$list1;
				
				$list3 = $list3;
				$num1 = sizeof($list1);

				for($i = 0;$i<$num1;$i++)
				{ ?>
					<input value="<?php echo $list1[$i]; ?>" type="checkbox" name="Assign_To[]" class="checkitem"><?php echo $list3[$i]; ?><br>
				<?php } ?>
				<br>
				</div>
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

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script>
		$("#checkall").change(function(){
			$(".checkitem").prop("checked",$(this).prop("checked"))
		})

		var expanded = false;
		function showcheckboxes() {
			var checkboxes = document.getElementById("checkboxes");
			if (!expanded) {
				checkboxes.style.display = "block";
				expanded = true;
			} else {
				checkboxes.style.display = "none";
				expanded = false;
			}
		}
	</script>

</body>
</html>