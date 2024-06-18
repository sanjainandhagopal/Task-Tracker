<?php 

$conn = mysqli_connect("localhost","root","","task manager");

if(!$conn)
{
	exit("Sorry, connection error...");
}

$val = $GET["value"];

$val_M = mysqli_real_escape_string($conn,$val);

$sql = "SELECT * FROM staff WHERE Dept='$val_M'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)
{
	echo"<select>";

	while ($rows = mysqli_fetch_assoc($result)) 
	{
		echo "<option>".$row["Name"]."</option>";
	}

	echo "</select>";
}

 ?>