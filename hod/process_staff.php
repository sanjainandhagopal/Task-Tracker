<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

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
	$temp_result = $mysqli -> query("SELECT * FROM hod WHERE log_id='$admin_id'") or die($mysqli -> error());
	$temp_row = $temp_result -> fetch_array();
	$admin_name = $temp_row['Name'];
	$From1 = mysqli_real_escape_string($mysqli,$admin_name);
	$Role1 = "HOD";
	$Dep1 = $temp_row['Dept'];
	$Dep1 = "/".$Dep1;
	$Dep1 = mysqli_real_escape_string($mysqli,$Dep1);

	$To2 = mysqli_real_escape_string($mysqli,$_POST['Assign_To']);
	$to_res = $mysqli -> query("SELECT * FROM staff WHERE Name='$To2'");
	$to_row = $to_res -> fetch_array();
	$Role2 = $to_row['Role2'];
	$Dep2 = $to_row['Dept'];
	$Dep2 = "/".$Dep2;
	$Dep2 = mysqli_real_escape_string($mysqli,$Dep2);
	
	$Begins = date("y-m-d");
	
	$Task = mysqli_real_escape_string($mysqli,$_POST['Task']);
	
	$Ends = $_POST['Dead_Line'];
	$Remarks = mysqli_real_escape_string($mysqli,$_POST['Remarks']);

	if(strtotime($Begins)<=strtotime($Ends))
	{
		if($To2 == 'staff')
		{
			$tem_dep = $temp_row['Dept'];
			$conn = mysqli_connect("localhost","root","","task manager");
			$sql = "SELECT * FROM staff WHERE Dept='$tem_dep'";
			$result = $conn->query($sql);
			$list1 = [];
			$list2 = [];
			$list3 = [];
			$list4 = [];
			$num = 0;

			if($result->num_rows>0)
			{
				while ($row = $result->fetch_assoc()) 
				{
					$list1[$num] = mysqli_real_escape_string($mysqli,$row['Name']);
					$Dep3 = $row['Dept'];
					$Dep3 = "/".$Dep3;
					$Dep3 = mysqli_real_escape_string($mysqli,$Dep3);
					$list2[$num] = $Dep3;
					$list3[$num] = $row['Role2'];
					$list4[$num] = $row['email'];
					$num++;
				}

				$num1 = sizeof($list1);

				for($i = 0;$i<$num1;$i++)
				{
					$mysqli -> query("INSERT INTO tasks(From1,Role1,Dep1,To2,Role2,Dep2,Task,Begins,Ends,Remarks) values('$From1','$Role1','$Dep1','$list1[$i]','$list3[$i]','$list2[$i]','$Task','$Begins','$Ends','$Remarks')") or die($mysqli -> error());

					$mail = new PHPMailer(true);

						try {
							//Server settings
							
							$mail->isSMTP();                                            //Send using SMTP
							$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
							$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
							$mail->Username   = 'tasktracker541@gmail.com';                     //SMTP username
							$mail->Password   = 'jfnismcmximaofse';                               //SMTP password
							$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
							$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
						
							//Recipients
							$mail->setFrom('tasktracker541@gmail.com', 'Task Tracker');
							$mail->addAddress($list4[$i]);     //Add a recipient
						
							//Content
							$mail->isHTML(true);                                  //Set email format to HTML
							$mail->Subject = $Begins;
							$mail->Body    = 'Dear Sir/Madam, <br>    You got a new task. For more details follow the description.
							<br><br><br>
							<b>From : </b>'.$From1.' ['.$Role1.']<br>
							<b>Deadline : </b>'.$Ends.'<br>
							<b>Task : </b>'.$Task.'<br>
							<b>Remarks : </b>'.$Remarks.'<br><br>
							Thank you for reading,<br>
							Have a energetic day Sir/Madam.';
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
						
							$mail->send();
							echo 'Message has been sent';
						} catch (Exception $e) {
							echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}
				}
			}

		}
		else if($To2 == 'self')
		{
			$self = "Self";
			$mysqli -> query("INSERT INTO tasks(From1,Role1,Dep1,To2,Role2,Dep2,Task,Begins,Ends,Remarks) values('$From1','$Role1','$Dep1','$self','','','$Task','$Begins','$Ends','$Remarks')") or die($mysqli -> error());
		}
		else
		{
			$mysqli -> query("INSERT INTO tasks(From1,Role1,Dep1,To2,Role2,Dep2,Task,Begins,Ends,Remarks) values('$From1','$Role1','$Dep1','$To2','$Role2','$Dep2','$Task','$Begins','$Ends','$Remarks')") or die($mysqli -> error());
			
			$mail = new PHPMailer(true);

						try {
							//Server settings
							
							$mail->isSMTP();                                            //Send using SMTP
							$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
							$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
							$mail->Username   = 'tasktracker541@gmail.com';                     //SMTP username
							$mail->Password   = 'jfnismcmximaofse';                               //SMTP password
							$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
							$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
						
							//Recipients
							$mail->setFrom('tasktracker541@gmail.com', 'Task Tracker');
							$mail->addAddress($to_row['email']);     //Add a recipient
						
							//Content
							$mail->isHTML(true);                                  //Set email format to HTML
							$mail->Subject = $Begins;
							$mail->Body    = 'Dear Sir/Madam, <br>    You got a new task. For more details follow the description.
							<br><br><br>
							<b>From : </b>'.$From1.' ['.$Role1.']<br>
							<b>Deadline : </b>'.$Ends.'<br>
							<b>Task : </b>'.$Task.'<br>
							<b>Remarks : </b>'.$Remarks.'<br><br>
							Thank you for reading,<br>
							Have a energetic day Sir/Madam.';
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
						
							$mail->send();
							echo 'Message has been sent';
						} catch (Exception $e) {
							echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}
		}

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
	$to_res = $mysqli -> query("SELECT * FROM staff WHERE Name='$To2'");
	$to_row = $to_res -> fetch_array();
	$Role2 = $to_row['Role2'];
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