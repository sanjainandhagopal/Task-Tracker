<?php 

$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$Begins = '';
$From1 = '';
$Task = '';
$To2 = '';
$Dep2 = '';
$Ends = '';
$Remarks = '';

if (isset($_POST['save'])) {

	session_start();
	$admin_id = $_SESSION['log_id'];
	$temp_result = $mysqli -> query("SELECT * FROM administrator WHERE log_id='$admin_id'") or die($mysqli -> error());
	$temp_row = $temp_result -> fetch_array();
	$admin_name = $temp_row['Name'];
	$From1 = mysqli_real_escape_string($mysqli,$admin_name);
	$Role1 = mysqli_real_escape_string($mysqli,$temp_row['Role']);
	$Dep1 = "";

	$To2 = mysqli_real_escape_string($mysqli,$_POST['Assign_To']);
	$to_res = $mysqli -> query("SELECT * FROM hod WHERE Name='$To2'");
	$to_row = $to_res -> fetch_array();
	$Role2 = "HOD";
	$Dep2 = $to_row['Dept'];
	$Dep2 = "/".$Dep2;
	$Dep2 = mysqli_real_escape_string($mysqli,$Dep2);
	
	$Begins = date("y-m-d");
	
	$Task = mysqli_real_escape_string($mysqli,$_POST['Task']);
	
	$Ends = $_POST['Dead_Line'];
	$Remarks = mysqli_real_escape_string($mysqli,$_POST['Remarks']);

	if(strtotime($Begins)<=strtotime($Ends))
	{
		$mysqli -> query("INSERT INTO tasks(From1,Role1,Dep1,To2,Role2,Dep2,Task,Begins,Ends,Remarks) values('$From1','$Role1','$Dep1','$To2','$Role2','$Dep2','$Task','$Begins','$Ends','$Remarks')") or die($mysqli -> error());

		$_SESSION['message'] = "Record has been saved...";
		$_SESSION['msgtype'] = "Success";

		header("location:Task.php");
	}
	else
	{
		echo "You want to give a reasonable  date";
	}

	
}

if (isset($_GET['delete'])) {
	$ID = $_GET['delete'];

	$mysqli -> query("DELETE FROM tasks WHERE ID='$ID'") or die($mysqli -> error());

	$_SESSION['message'] = "Record has been deleted...";
	$_SESSION['msgtype'] = "danger";

	header("location:Task.php");
}

if (isset($_GET['edit'])) {
	$ID = $_GET['edit'];
	$update = true;
	$result = $mysqli -> query("SELECT * FROM tasks WHERE ID='$ID'") or die($mysqli -> error());

	
		$row = $result -> fetch_array();

		$To2 = mysqli_real_escape_string($mysqli,$row['To2']);

		$Task = mysqli_real_escape_string($mysqli,$row['Task']);
		$Assign_To = $row['To2'];
		$Dead_Line = $row['Ends'];
		$Remarks = $row['Remarks'];
	
}

if (isset($_POST['update'])) {
	
	$ID = $_POST['ID'];
	$Begins = date("y-m-d");

	session_start();
	$admin_id = $_SESSION['log_id'];
	$temp_result = $mysqli -> query("SELECT * FROM administrator WHERE log_id='$admin_id'") or die($mysqli -> error());
	$temp_row = $temp_result -> fetch_array();
	$admin_name = $temp_row['Name'];
	$From1 = mysqli_real_escape_string($mysqli,$admin_name);
	$Role1 = mysqli_real_escape_string($mysqli,$temp_row['Role']);
	$Dep1 = "";

	$Task = mysqli_real_escape_string($mysqli,$_POST['Task']);
	$To2 = mysqli_real_escape_string($mysqli,$_POST['Assign_To']);
	$Role2 = "HOD";
	$to_res = $mysqli -> query("SELECT * FROM hod WHERE Name='$To2'");
	$to_row = $to_res -> fetch_array();
	$Dep2 = $to_row['Dept'];
	$Dep2 = "/".$Dep2;
	$Dep2 = mysqli_real_escape_string($mysqli,$Dep2);

	$Ends = $_POST['Dead_Line'];
	$Remarks = mysqli_real_escape_string($mysqli,$_POST['Remarks']);

	$mysqli -> query("UPDATE tasks SET From1 = '$From1',Role1 = '$Role1',Dep1 = '$Dep1',To2 = '$To2',Role2 = '$Role2',Dep2 = '$Dep2',Task = '$Task',Begins = '$Begins',Ends = '$Ends',Remarks = '$Remarks' WHERE ID='$ID'") or die($mysqli -> error());

	$_SESSION['message'] = "Record has been updated successfully...";
	$_SESSION['msgtype'] = "warning";

	header("location:Task.php");
}

if (isset($_GET['State'])) {
	
	$ID = $_GET['State'];
	$change = "comp";

	$result = $mysqli -> query("SELECT * FROM tasks WHERE ID='$ID'") or die($mysqli -> error());
	$row = $result -> fetch_array();
	$val = $row['State'];
	settype($val, "integer");

	$mysqli -> query("UPDATE tasks SET State = '$change' WHERE ID='$ID'") or die($mysqli -> error());

	header("location:Task.php");
}

if (isset($_GET['undo'])) {
	
	$ID = $_GET['undo'];
	$change = "Not";

	$result = $mysqli -> query("SELECT * FROM tasks WHERE ID='$ID'") or die($mysqli -> error());
	$row = $result -> fetch_array();
	$val = $row['State'];
	settype($val, "integer");

	$mysqli -> query("UPDATE tasks SET State = '$change' WHERE ID='$ID'") or die($mysqli -> error());

	header("location:Task.php");
}

if (isset($_GET['acces'])) {
	
	$ID = $_GET['acces'];
	$change = "comp";

	$result = $mysqli -> query("SELECT * FROM tasks WHERE ID='$ID'") or die($mysqli -> error());
	$row = $result -> fetch_array();
	$val = $row['State'];
	settype($val, "integer");

	$mysqli -> query("UPDATE tasks SET State = '$change' WHERE ID='$ID'") or die($mysqli -> error());

	header("location:Task.php");
}

if (isset($_GET['req'])) {
	
	$ID = $_GET['req'];
	$change = "request";

	$result = $mysqli -> query("SELECT * FROM tasks WHERE ID='$ID'") or die($mysqli -> error());
	$row = $result -> fetch_array();
	$val = $row['State'];
	settype($val, "integer");

	$mysqli -> query("UPDATE tasks SET State = '$change' WHERE ID='$ID'") or die($mysqli -> error());

	header("location:Task.php");
}

if (isset($_GET['Re-assign'])) {
	$ID = $_GET['Re-assign'];
	$update = true;
	$result = $mysqli -> query("SELECT * FROM tasks WHERE ID='$ID'") or die($mysqli -> error());

	
		$row = $result -> fetch_array();
		$Dead_Line = $row['Ends'];	
}

if (isset($_POST['re-assign'])) {
	
	$ID = $_POST['ID'];
	$Dead_Line = $_POST['Dead_Line'];
	$change = "Not";

	$mysqli -> query("UPDATE tasks SET Ends = '$Dead_Line',State = '$change' WHERE ID='$ID'") or die($mysqli -> error());

	$_SESSION['message'] = "Record has been updated successfully...";
	$_SESSION['msgtype'] = "warning";

	header("location:Task.php");
}

 ?>