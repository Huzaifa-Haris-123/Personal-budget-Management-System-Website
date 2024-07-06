<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Budget</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
    <div class="navBar">
        <img class="logo" src="logo.png" alt="">
        <a href="main.php?username=<?php echo $_GET['username']; ?>">Home</a>
        <a href="login.php">Log Out</a>
    </div>
    <div class="mainbox">
        <div class="sideBar">
            <b>User Name: </b>
            <?php
            $username = $_GET['username'];
            echo '<span "><b>'. $username . '<b></span>';
            ?><br>
            <b>Dashboard</b><br>
            <b>Income Tracking</b>
            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <input class="inputClass"  type="submit" value="View Income" name='viewinccheck'>
            </form>
            <?php

        if(isset($_GET['viewinccheck']))
            {
                $username = $_GET['username'];
                header("Location: Viewincome.php?username=". urlencode($username));
                exit;
            }
            
           ?>
            <form action="Addincome.php" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username']; ?>">
                <input class="inputClass"  type="submit" value="Add Income" name='incomecheck'>
            </form>
            <?php
            if(isset($_GET['incomecheck']))
            {
                $username = $_GET['username'];
                header("Location: Addincome.php?username=" . urlencode($username));
                exit;
            }
            ?>


            <b>Expense Tracking</b>
            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <input class="inputClass"  type="submit" value="View Expense" name='viewexccheck'>
            </form>
            <?php
            if(isset($_GET['viewexccheck']))
            {
                $username = $_GET['username'];
                header("Location: Viewexpense.php?username=". urlencode($username));
                exit;
            }
            ?>


            <form action="Addexpense.php" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username']; ?>">
                <input class="inputClass"  type="submit" value="Add Expense" name='expensecheck'>
            </form>
            <?php
            if(isset($_GET['expensecheck']))
            {
                $username = $_GET['username'];
                header("Location: Addexpense.php?username=" . urlencode($username));
                exit;
            }
            ?>


            <b>Budget Planing</b>
            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <input class="inputClass"  type="submit" value="Set Budget" name='budgetcheck'>
            </form>
            <?php
            if(isset($_GET['budgetcheck']))
            {
                $username = $_GET['username'];
                header("Location: Setbudget.php?username=". urlencode($username));
                exit;
            }
            ?>


            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <input class="inputClass"  type="submit" value="View Budget" name='budgetview'>
            </form>
            <?php
            if(isset($_GET['budgetview']))
            {
                $username = $_GET['username'];
                header("Location: Viewbudget.php?username=". urlencode($username));
                exit;
            }
            ?>


        </div>
        <div class="rightmainbox">
    <?php
    $username = $_GET['username'];
    $conn = new mysqli('localhost', 'root', '', 'budget management');
    $query = "SELECT * FROM `budgettable` WHERE UserName='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr style='background-color: #f0f0f0;'><th style='width: 100px;'>Category</th><th style='width: 100px;'>Budget</th></tr>";
        $categories = array("Grocery", "Clothing", "Education", "Food", "Transportation", "Entertainment", "Other");
        foreach ($categories as $category) {
            echo "<tr>";
            echo "<td style='width: 100px;'>$category</td>";
            echo "<td style='width: 100px;'>". $rows[0][$category]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }

    $conn->close();
   ?>
</div>
    </div>
</body>
</html>