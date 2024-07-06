
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="stylesheet.css">
    <!-- Login Font (Borel)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel&display=swap" rel="stylesheet">

    <!-- User Name & Password Font (Edu SA Beginner)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel&family=Edu+SA+Beginner&display=swap" rel="stylesheet">

</head>

<body class="mainBox" style="font-family:Edu SA Beginner ;">
    <div class="menuBox">
        <span class="loginHeading" style="font-family: Borel;">Login</span><br>
        <div class="content">
            Username
            <form action="" method='GET'>
                <input type="text" class="inputBox" name='userName'
                    placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Type your Username">
            <br>
            Password
           
                <input type="password" class="inputBox" name='pass'
                    placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type your Password"><br>
            
                <span style="font-size: medium; padding-left: 77%; text-decoration: none;">Forgot password?</a></span><br><br>
                <input class='bttn' type="submit" value="Login">
            </form>
                </a><br><br><br><br>
               
                <span style="padding-left: 16rem;">Or Sign Up Using</span><br><br>
                <a href="signup.php"><button class="lowerButton" >Sign Up</button></a>

        <?php
        if(isset($_GET['userName']) && isset($_GET['pass']))
        {
            $userNaam=$_GET["userName"];
            $pas1=$_GET["pass"];
            if($userNaam=='' || $pas1=='')
            {
                echo'<center><span style=color:red ;> Fill all the requird fields!!!</center>';
            }
            else{
                $conn = new mysqli('localhost','root','','budget management');
                $query = "SELECT UserName FROM user WHERE UserName = '$userNaam'";
                $result = $conn->query($query);
                if($result->num_rows==0)
                {
                    echo'<center><span style=color:red ;> This userName Doesnot exist!!!</center>';
                    $conn->close();
                }
                else
                {
                    $query = "SELECT userName FROM user WHERE UserName = '$userNaam' and Password='$pas1'";
                    $result = $conn->query($query);
                    if($result->num_rows==0)
                    {
                        echo'<center><span style=color:red ;> Password Doesnot match!!!</center>';
                        $conn->close();
                    }
                    else
                    {
                        $conn->close();
                        header("Location: main.php?username=" . urlencode($userNaam));
                        exit;
                    }
                }

            }
        }
        ?>
            
        </div>
        <br><br>
    </div>
   
</body>

</html>

