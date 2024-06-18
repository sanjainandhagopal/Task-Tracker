<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Singlton Task</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<link rel="stylesheet" type="text/css" href="../CSS1/Form.css">
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
		top: 300px;
		left: 550px;
		max-width: 400px;
		height:100px;
		padding: 10px 45px 30px 45px;
		text-align: left;
		box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		border-radius: 10px;
	}

	form a
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

	form a:hover, form a:active, form a:focus
	{
		background-color: #06C5CF;
		transition: all 0.1s ease 0s;
	}

	a
	{
		text-decoration: none;
		color: #FFFFFF;
	}
</style>

<body>
<a href="Home.php" class="Back" color="red">Return</a>
	<div class="form">
	<form>
		<br><br>
		<a href="Admin_get.php">Administration</a>
		<a href="Staff_get.php">Staff</a>

	</form>
	</div>	

</body>
</html>