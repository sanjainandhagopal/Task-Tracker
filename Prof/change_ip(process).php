<?php 
$conn = mysqli_connect("localhost","root","","task manager");

if (isset($_POST['login'])) {
	$aname = $_POST['aname'];
	$o_apass = $_POST['o_apass'];
	$apass = $_POST['apass'];

	session_start();
	$admin_id = $_SESSION['log_id'];

	$result = $conn -> query("SELECT * FROM staff WHERE log_id='$admin_id'") or die($mysqli -> error());
	$row = $result -> fetch_array();

	if ($o_apass==$apass) 
	{
		$conn -> query("UPDATE staff SET log_id = '$aname',pass = '$apass' WHERE log_id='$admin_id'") or die($mysqli -> error());
		header("location:../Admin_login.php");
	}
	else
	{
		echo "<script>
		window.location.href='change_ip.php';
        alert('Please enter the coeecr ID or Password');
       	</script>";
	}	
}
 ?>