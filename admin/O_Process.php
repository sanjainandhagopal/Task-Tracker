<?php 

$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$Date = '';
$Event = '';
$E_event = '';
$Remarks = '';


if (isset($_POST['save'])) {
	
	$Date = $_POST['Date'];
	$Event = $_POST['Event'];
	$Remarks = $_POST['Remarks'];

	if(empty($_POST['E_event']))
	{
		$E_event = $_POST['Date'];
	}
	else
	{
		$E_event = $_POST['E_event'];
	}

	if($Date>$E_event)
	{
		echo "You want to give a reasonable date";
	}
	else
	{
		$mysqli -> query("INSERT INTO y_once(Date,Event,E_event,Remarks) values('$Date','$Event','$E_event','$Remarks')") or die($mysqli -> erro());

		$_SESSION['message'] = "Record has been saved...";
		$_SESSION['msgtype'] = "Success";

		header("location:once.php");
	}

	
}

if (isset($_GET['delete'])) {
	$ID = $_GET['delete'];

	$mysqli -> query("DELETE FROM y_once WHERE ID='$ID'") or die($mysqli -> error());

	$_SESSION['message'] = "Record has been deleted...";
	$_SESSION['msgtype'] = "danger";

	header("location:once.php");
}

if (isset($_GET['edit'])) {
	$ID = $_GET['edit'];
	$update = true;
	$result = $mysqli -> query("SELECT * FROM y_once WHERE ID='$ID'") or die($mysqli -> error());

	
		$row = $result -> fetch_array();
		$Date = $row['Date'];
		$Event = $row['Event'];
		$E_event = $row['E_event'];
		$Remarks = $row['Remarks'];
	
}

if (isset($_POST['update'])) {
	
	$ID = $_POST['ID'];
	$Date = $_POST['Date'];
	$Event = $_POST['Event'];
	$E_event = $_POST['E_event'];
	$Remarks = $_POST['Remarks'];

	$mysqli -> query("UPDATE y_once SET Date = '$Date',Event = '$Event',E_event = '$E_event',Remarks = '$Remarks' WHERE ID='$ID'") or die($mysqli -> error);

	$_SESSION['message'] = "Record has been updated successfully...";
	$_SESSION['msgtype'] = "warning";

	header("location:once.php");
}

 ?>