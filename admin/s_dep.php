<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Singlton Task</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<style type="text/css">

	body
	{
		padding: 0;
		margin: 0;
		background-image: url(../Images/campus.jpg);
		background-repeat: no-repeat;
		background-size: cover;
		height: 100vh;
	}

	form
	{
		font-family: "Roboto", sans-serif;
		position: absolute;
		z-index: 1;
		background: #FFFFFF;
		opacity: 99%;
		top: 200px;
		left: 550px;
		max-width: 350px;
		height: 130px;
		padding: 10px 45px 30px 45px;
		text-align: left;
		box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		border-radius: 10px;
	}

	form button
	{
		margin: 10px;
		text-transform: uppercase;
		outline: 0;
		border-radius: 10px;
		background: #1ADBE5;
		width: 100%;
		border: 0;
		padding: 15px;
		
		font-size: 14px;
		cursor: pointer;
	}

	form button:hover, form button:active, form button:focus
	{
		background-color: #06C5CF;
		transition: all 0.1s ease 0s;
	}

	a
	{
		text-decoration: none;
		color: #FFFFFF;
	}
	a:hover
	{
		text-decoration: none;
		color: white;
	}

	#second{
		position:absolute;
		left:10px;
	}
</style>

<body>
<a href="Home.php" class="Back" color="red">Return</a>

	<form>

	  	<div class="btn-group" role="group" aria-label="Basic example" id="first">
			  <a class="btn btn-secondary" href="IT.php">IT</a>
			  <a class="btn btn-secondary" href="CSBS.php">CSBS</a>
			  <a class="btn btn-secondary" href="AIDS.php">AI&DS</a>
			  <a class="btn btn-secondary" href="CSE.php">CSE</a>
		</div>

		<br><br>

		<div class="btn-group" role="group" aria-label="Basic example" id="second">
			  <a class="btn btn-secondary" href="ECE.php">ECE</a>
			  <a class="btn btn-secondary" href="EEE.php">EEE</a>
			  <a class="btn btn-secondary" href="MECH.php">MECH</a>
			  <a class="btn btn-secondary" href="CIVIL.php">CIVIL</a>
			  <a class="btn btn-secondary" href="MBA.php">MBA</a>
		</div>

	</form>

</body>
</html>

