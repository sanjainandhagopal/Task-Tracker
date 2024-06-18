<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change I/P</title>
    <link rel="stylesheet" type="text/css" href="../c_ip(css).css">
    <link rel="stylesheet" type="text/css" href="../CSS1/Home.css">
</head>
<body>
<style>
.Back
{
	text-transform: uppercase;
	outline: 0;
	border-radius: 10px;
	background: #f20707;
	position: absolute;
	top: 10px;
	left: 10px;
	width: 100px;
	
	border: 0;
	padding: 15px;
	color: #FFFFFF;
	font-size: 14px;
	cursor: pointer;
	text-decoration: none;
}

.Back:hover
{
	background-color: #830c0c;
}
</style>
<a href="Home.php" class="Back" color="red">Return</a>
    <?php require 'change_email(process).php'; ?>
<div class="login">
            <div class="log">
                <div class="login-box">
                    <img src="../avatar1.png" class="avatar1"><br><br>
                    <form method="POST" name="Form1" action="change_email(process).php">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">

                        <label>New Email ID :</label>
                        <input type="text" name="mail1" placeholder="Enter Email ID" required class="input">
                        <label>Confirm Email ID :</label>
                        <input type="text" name="mail2" placeholder="Enter Email ID" required class="input">

                        <button  type="submit" class="btn" name="savemail">Save mail</button>

                    </form>

                </div>
            </div>
    </div>

</body>

</html>