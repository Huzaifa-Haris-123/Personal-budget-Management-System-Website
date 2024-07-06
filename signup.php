<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
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

<body class="mainBox" style="font-family:Edu SA Beginner;">
    <div class="menuBox">
        <span class="loginHeading" style="font-family: Borel;">Sign Up</span><br>
        <div class="content">
            Username
            <form action="" method="GET">
                <input type="text" class="inputBox" name="userName"
                    placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Type your Username">
                <br><br>
                Password
                <input type="password" class="inputBox" name="password1"
                    placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Password">
                <br><br>
                Confirm Password
                <input type="password" class="inputBox" name="password2"
                    placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm Password">
                <br><br>
                Security Question to reset Password
                <input type="text" class="inputBox" name="question"
                    placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;What was your first mobile model?">
                <br><br>

                <input type="submit" class="bttn" value="Sign Up"><br><br><br><br>
            </form>

            <span style="padding-left: 16rem;">Or Login Using</span><br><br>
            <a href="login.php"><button class="lowerButton">Login</button></a>
            <?php
if(isset($_GET["userName"]) && isset($_GET["password1"]) && isset($_GET["password2"]) && isset($_GET["question"])) {
    
   
    $userNaam=$_GET["userName"];
    $pas1=$_GET["password1"];
    $pas2=$_GET["password2"];
    $secure=$_GET["question"];
    
    if($userNaam=='' || $pas1=='' ||$pas2=='' || $secure=='')
    {
        echo'<center><span style=color:red ;> Fill all the requird fields!!!</center>';
    }
    else if($pas1!=$pas2)
    {
        echo'<center><span style=color:red ;> Password Doesnot match!!!</center>';
    }
    
    // Create connection
    else{
        $conn = new mysqli('localhost','root','','budget management');
        $query = "SELECT UserName FROM user WHERE UserName = '$userNaam'";
        $result = $conn->query($query);
        if($result->num_rows>0)
        {
            echo'<br>';echo'<br>';
            echo'<center><span style=color:red ;> This userName already exist!!!</center>';
        }
        else
        {
            $date=date("Y-m-d");
            $query="INSERT INTO `user`(`UserName`, `Password`, `DOJ`, `Answer`) VALUES ('$userNaam','$pas1','$date','$secure')";
            $conn->query($query);
            

            $query="INSERT INTO `income`(`UserName`, `DOI`) VALUES ('$userNaam','$date')";
            $conn->query($query);

            $query="INSERT INTO `expense`(`UserName`, `DOE`) VALUES ('$userNaam','$date')";
            $conn->query($query);
            $query="INSERT INTO `budgettable`(`UserName`) VALUES ('$userNaam')";
            $conn->query($query);
            echo'<center><span style=color:#2da16d ;> You have registered as our member successfully!!!</center>';
        }
        $conn->close();
    }
   
    
   
}
?> 

        </div>
        <br><br>
    </div>
    
</body>

</html>
