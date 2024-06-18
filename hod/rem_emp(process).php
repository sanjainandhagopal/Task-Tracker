<?php 

$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$Name = '';
$Role = '';
$log_id= '';
$pss= '';

if (isset($_GET['Remove'])) {
	$ID = $_GET['Remove'];

	$mysqli -> query("DELETE FROM administrator WHERE ID=$ID") or die($mysqli -> error());

	header("location:show_emp.php");
}

if (isset($_GET['Change'])) {
	$ID = $_GET['Change'];
	$update = true;
	$result = $mysqli -> query("SELECT * FROM administrator WHERE ID=$ID") or die($mysqli -> error());

	
	$row = $result -> fetch_array();
	$Name = $row['Name'];
	$Role = $row['Role'];
	$dep_id = $row['log_id'];
	$pss = $row['pss'];
}

if (isset($_POST['update'])) {
	
	$ID = $_POST['ID'];
	$Name = mysqli_real_escape_string($mysqli,$_POST['Name']);
	$Role = mysqli_real_escape_string($mysqli,$_POST['Role']);
	$log_id = mysqli_real_escape_string($mysqli,$_POST['log_id']);
	$pss = mysqli_real_escape_string($mysqli,$_POST['pss']);

	$mysqli -> query("UPDATE administrator SET Name = '$Name',Role = '$Role',log_id = '$log_id',pss = '$pss' WHERE ID='$ID'") or die($mysqli -> error());

	header("location:show_emp.php");
}


?>