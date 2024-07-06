<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Budget</title>
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
            if (isset($_GET['username'])) {
                $username = $_GET['username'];
                echo '<span "><b>'. $username. '<b></span>';
            }
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
        <h2>Set Budget for a Category</h2>
            <div class="inp">
           
            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <label for="category">Select Category:</label>
                <select id="category" name="category">
                    <option value="Grocery">Grocery</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Education">Education</option>
                    <option value="Food">Food</option>
                    <option value="Transportation">Transportation</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Other">Other</option>
                </select>
                <br><br>
                <label for="budget_amount">Budget Amount:</label>
                <input class="inputClass"  type="text" id="budget_amount" name="budget_amount" required>
                <br><br>
                <input class="inputClass"  type="submit" value="Set Budget" name='set_budget'>
            </form>
            <?php
            if (isset($_GET['set_budget'])) {
                $username = $_GET['username'];
                $category = $_GET['category'];
                $budget_amount = $_GET['budget_amount'];

                $conn = new mysqli('localhost', 'root', '', 'budget management');
                $query = "UPDATE `budgettable` SET `$category` = '$budget_amount' WHERE UserName = '$username'";
                $conn->query($query);

                $conn->close();
                echo '<center><span style="color:green;"> Budget set successfully!</span></center>';
            }
            ?>
        </div>
            </div>
            
    </div>
</body>
</html>