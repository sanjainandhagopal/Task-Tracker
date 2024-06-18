<?php
    include "login_backend.php";
    session_start();
                   if(!isset($_SESSION["AID"]))
?>

<!DOCTYPE html>
<html>

<head>
 <title>Login</title>
 <link rel="stylesheet" type="text/css" href="login(css).css">
</head>

<body>
    <div class="login">
        <h1>Admin Can Login Here</h1>
            <div class="log">
                <?php
                if(isset($_POST["login"]))
                    {
                        
                        //$sql="select * from admin WHERE ANAME='{$_POST["aname"]}' and APASS='{$_POST["apass"]}'";
                        //$res=$db->query($sql);

                        $sql="select * from administrator WHERE log_id='{$_POST["aname"]}' and pss='{$_POST["apass"]}'";
                        $res=$db->query($sql);

                        $sql1="select * from HOD WHERE log_id='{$_POST["aname"]}' and pass='{$_POST["apass"]}'";
                        $res1=$db->query($sql1);

                        $sql2="select * from staff WHERE log_id='{$_POST["aname"]}' and pass='{$_POST["apass"]}'";
                        $res2=$db->query($sql2);

                        if($res->num_rows>0)
                        {
                            $ro=$res->fetch_assoc();
                            $_SESSION["log_id"]=$ro["log_id"];
                            $_SESSION["pss"]=$ro["pss"];

                            echo "<script>window.open('admin/Home.php','_self');</script>";
                        }
                        elseif ($res1->num_rows>0) 
                        {
                            $ro=$res1->fetch_assoc();
                            $_SESSION["log_id"]=$ro["log_id"];
                            $_SESSION["pass"]=$ro["pass"];

                            echo "<script>window.open('Hod/Home.php','_self');</script>";
                        }
                        elseif($res2->num_rows>0)
                        {
                            $ro=$res2->fetch_assoc();
                            $_SESSION["log_id"]=$ro["log_id"];
                            $_SESSION["pass"]=$ro["pass"];

                            echo "<script>window.open('Prof/Home.php','_self');</script>";
                        }
                        else
                        {
                            echo "<script>
                                alert('Please enter the correct ID or Password');
                            </script>";
                        }
                    
                    }
                    if(isset($_GET["mes"]))
                    {
                        echo "<div class='error'>{$_GET["mes"]}</div>";
                    }
                ?>

                <div class="login-box">

                    <img src="avatar1.png" class="avatar1">

                    <form method="post" name="Form1" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <label>Admin ID :</label>
                    <input type="text" name="aname" placeholder="Enter Admin ID" required class="input">
                    <label>Password :</label>
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