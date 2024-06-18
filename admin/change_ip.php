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
    <?php require 'change_ip(process).php'; ?>
<div class="login">
            <div class="log">
                <div class="login-box">
                    <img src="../avatar1.png" class="avatar1">
                    <form method="POST" name="Form1" action="change_ip(process).php">
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>">

                        <label>New Admin ID :</label>
                        <input type="text" name="aname" placeholder="Enter Admin ID" required class="input">
                        <label>New Password :</label>
                        <input type="password" name="o_apass" placeholder="Enter Password" required class="input" id="myInput">
                        <label>Re-enter Password :</label>
                        <input type="password" name="apass" placeholder="Enter Password" required class="input" id="myInput">
                        <input type="checkbox" onclick="myFunction()"><label>Show Password</label><br> <br>

                        <script>
                            function myFunction() {
                            var x = document.getElementById("myInput");
                            if (x.type === "password") 
                            {
                                x.type = "text";
                            } 
                            else 
                            {
                                x.type = "password";
                            }
                            }
                        </script>

                        <button  type="submit" class="btn" name="login">Login</button>

                    </form>

                </div>
            </div>
    </div>

</body>

</html>