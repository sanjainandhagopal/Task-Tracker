<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Singlton Task</title>
	<link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
	<link rel="stylesheet" href="../CSS1/Form.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
		left: 40%;
		top: 200px;
		width: 300px;
		padding: 10px 45px 30px 45px;
		text-align: center;
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
		width: 200px;
		border: 0;
		padding: 15px;
		font-size: 14px;
		
	}

	form a:hover, form a:active, form a:focus
	{
		background-color: #06C5CF;
		transition: all 0.1s ease 0s;
	}

	a
	{
		text-decoration: none;
		text-align: center;
		color: #FFFFFF;
	}
	a:hover
	{
		text-decoration: none;
		color: white;
		cursor: pointer;
	}
</style>

<body>
<a href="Home.php" class="Back" color="red">Return</a>

	<div class="form">
		<center>
			<form>
				<h5>Please select</h5>
				<a href="Hod_get.php" class="btn btn-info">HoD</a>
				<a href="Admin_get.php" class="btn btn-info">Administration</a>
				<a href="Staff_get.php" class="btn btn-info">S&H</a>
				<a href="s_dep.php" class="btn btn-info">Teaching Faculty</a>

			</form>
		</center>
	</div>	

</body>
</html>