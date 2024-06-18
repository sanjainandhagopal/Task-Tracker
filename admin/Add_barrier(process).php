<?php 

$mysqli = new mysqli('localhost','root','','task manager') or die(mysqli_error($mysqli));



$id = 0;
$update = false;
$staff_name = '';
$staff_role= '';
$staff_id='';
$password= '';

if (isset($_POST['save'])) {
	
	$staff_name = $_POST['Name'];
	$staff_role = $_POST['Role'];
	$staff_id = $_POST['staff_id'];
	$password = $_POST['password'];

	if(!empty($staff_name))
	{
		
		$mysqli -> query("INSERT INTO ob(Name,Role,staff_id,password) values('$staff_name','$staff_role','$staff_id','$password')") or die($mysqli -> error());

		
	}
	else
	{
		echo "Please Enter All Fields";
	}

	header("location:show_bar.php");
	
}

if (isset($_GET['Remove'])) {
	$ID = $_GET['Remove'];

	$result = $mysqli -> query("SELECT * FROM staff WHERE ID='$ID'") or die($mysqli -> error());
	$row = $result -> fetch_array();
	$staff_name = $row['Name'];
	$Task_table = str_replace('.', '_', $staff_name).'_Task';
	$Task_table = str_replace(' ', '_', $Task_table);
	$y_o_table = str_replace('.', '_', $staff_name).'_y_once';
	$y_o_table = str_replace(' ', '_', $y_o_table);
	$y_t_table = str_replace('.', '_', $staff_name).'_y_t_event';
	$y_t_table = str_replace(' ', '_', $y_t_table);

	$mysqli -> query("DROP TABLE IF EXISTS $Task_table") or die($mysqli -> error());
	$mysqli -> query("DROP TABLE IF EXISTS $y_o_table") or die($mysqli -> error());
	$mysqli -> query("DROP TABLE IF EXISTS $y_t_table") or die($mysqli -> error());
	$mysqli -> query("DELETE FROM staff WHERE ID=$ID") or die($mysqli -> error());

	header("location:show_bar.php");
}

if (isset($_GET['Change'])) {
	$ID = $_GET['Change'];
	$update = true;
	$result = $mysqli -> query("SELECT * FROM staff WHERE ID='$ID'") or die($mysqli -> error());

	
	$row = $result -> fetch_array();
	$staff_name = $row['Name'];
	$Dept = $row['Dept'];
	$staff_id = $row['staff_id'];
	$password = $row['password'];
}

if (isset($_POST['update'])) {
	
	$ID = $_POST['ID'];
	$staff_name = $_POST['Name'];
	$staff_id = $_POST['staff_id'];
	$password = $_POST['password'];

	$result = $mysqli -> query("SELECT * FROM staff WHERE ID='$ID'") or die($mysqli -> error());
	$row = $result -> fetch_array();
	$F_Name = $row['Name'];
	$Task_table = str_replace('.', '_', $F_Name).'_Task';
	$Task_table = str_replace(' ', '_', $Task_table);
	$y_o_table = str_replace('.', '_', $F_Name).'_y_once';
	$y_o_table = str_replace(' ', '_', $y_o_table);
	$y_t_table = str_replace('.', '_', $F_Name).'_y_t_event';
	$y_t_table = str_replace(' ', '_', $y_t_table);
	$F_Task_table = str_replace('.', '_', $staff_name).'_Task';
	$F_Task_table = str_replace(' ', '_', $F_Task_table);
	$F_y_o_table = str_replace('.', '_', $staff_name).'_y_once';
	$F_y_o_table = str_replace(' ', '_', $F_y_o_table);
	$F_y_t_table = str_replace('.', '_', $staff_name).'_y_t_event';
	$F_y_t_table = str_replace(' ', '_', $F_y_t_table);
	
	$mysqli -> query("ALTER TABLE $Task_table RENAME TO $F_Task_table") or die($mysqli -> error());
	$mysqli -> query("ALTER TABLE $y_o_table RENAME TO $F_y_o_table") or die($mysqli -> error());
	$mysqli -> query("ALTER TABLE $y_t_table RENAME TO $F_y_t_table") or die($mysqli -> error());
	$mysqli -> query("UPDATE staff SET Name = '$staff_name',staff_id = '$staff_id',password = '$password' WHERE ID='$ID'") or die($mysqli -> error());

	header("location:show_bar.php");
}


?>