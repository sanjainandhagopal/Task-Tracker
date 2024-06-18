<?php 

$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$Date = '';
$Event = '';
$R_date = '';
$Remarks = '';

if (isset($_POST['save'])) {
	
	$Date = $_POST['Date'];
	$Event = $_POST['Event'];
	$R_date = $_POST['R_date'];
	$Remarks = $_POST['Remarks'];

	if($Date>$R_date || $Date == $R_date)
	{
		echo "<script>
			window.location.href='T_get_data.php';
			alert('Please enter the date in correct order');
		</script>";
	}
	else
	{
		$mysqli -> query("INSERT INTO y_t_event(Date,Event,R_date,Remarks) values('$Date','$Event','$R_date','$Remarks')") or die($mysqli -> error());

		$_SESSION['message'] = "Record has been saved...";
		$_SESSION['msgtype'] = "Success";

		header("location:twice.php");
	}

}

if (isset($_GET['delete'])) {
	$ID = $_GET['delete'];

	$mysqli -> query("DELETE FROM y_t_event WHERE ID='$ID'") or die($mysqli -> error());

	$_SESSION['message'] = "Record has been deleted...";
	$_SESSION['msgtype'] = "danger";

	header("location:twice.php");
}

if (isset($_GET['edit'])) {
	$ID = $_GET['edit'];
	$update = true;
	$result = $mysqli -> query("SELECT * FROM y_t_event WHERE ID='$ID'") or die($mysqli -> error());

	
		$row = $result -> fetch_array();
		$Date = $row['Date'];
		$Event = $row['Event'];
		$R_date = $row['R_date'];
		$Remarks = $row['Remarks'];
	
}

if (isset($_POST['update'])) {
	
	$ID = $_POST['ID'];
	$Date = $_POST['Date'];
	$Event = $_POST['Event'];
	$R_date = $_POST['R_date'];
	$Remarks = $_POST['Remarks'];

	$mysqli -> query("UPDATE y_t_event SET Date = '$Date',Event = '$Event',R_date = '$R_date',Remarks = '$Remarks' WHERE ID='$ID'") or die($mysqli -> error());

	$_SESSION['message'] = "Record has been updated successfully...";
	$_SESSION['msgtype'] = "warning";

	header("location:twice.php");
}

 ?>