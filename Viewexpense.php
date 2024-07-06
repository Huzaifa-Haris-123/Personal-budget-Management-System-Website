<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="common.css">
</html>
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
                <input class="inputClass"  class="inputClass" type="hidden" name="username" value="<?php echo $_GET['username'];?>">
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

                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <input class="inputClass"  type="submit" value="View Budget" name='budgetview'>
            </form>
            <?php
        if(isset($_GET['budgetcheck']))
            {
                $username = $_GET['username'];
                header("Location: Setbudget.php?username=". urlencode($username));
                exit;
            }
            
           ?>
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
$query = "SELECT `DateEntry`, `Amount`, `Category` FROM `expensedetail` WHERE UserName='$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Date Entry</th><th>Amount</th><th>Category</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $row["DateEntry"]. "</td>";
        echo "<td>". $row["Amount"]. "</td>";
        echo "<td>". $row["Category"]. "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
            
            ?>
    </div>
    <div>
    </div>

    </div>
</body>
</html>