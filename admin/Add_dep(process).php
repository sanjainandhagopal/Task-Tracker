<?php 

$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$Name = '';
$Dept = '';
$log_id= '';
$pass= '';

if (isset($_GET['Remove'])) {
	$ID = $_GET['Remove'];

	$mysqli -> query("DELETE FROM hod WHERE ID='$ID'") or die($mysqli -> error());

	header("location:show_dep.php");
}

if (isset($_GET['Change'])) {
	$ID = $_GET['Change'];
	$update = true;
	$result = $mysqli -> query("SELECT * FROM hod WHERE ID='$ID'") or die($mysqli -> error());

	
	$row = $result -> fetch_array();
	$Name = $row['Name'];
	$Dept = $row['Dept'];
	$dep_id = $row['log_id'];
	$pass = $row['pass'];
}

if (isset($_POST['update'])) {
	
	$ID = $_POST['ID'];
	$Name = mysqli_real_escape_string($mysqli,$_POST['Name']);
	$Dept = mysqli_real_escape_string($mysqli,$_POST['Dept']);
	$log_id = mysqli_real_escape_string($mysqli,$_POST['log_id']);
	$pass = mysqli_real_escape_string($mysqli,$_POST['pass']);

	$mysqli -> query("UPDATE hod SET Name = '$Name',Dept = '$Dept',log_id = '$log_id',pass = '$pass' WHERE ID='$ID'") or die($mysqli -> error());

	header("location:show_dep.php");
}


?>