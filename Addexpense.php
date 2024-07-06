<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'budget management');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from GET parameter
$username = $_GET['username'];

// Display total expense
$query = "SELECT Amount FROM expense WHERE UserName = '$username'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<center><span style="color:green;"> Your Total Expense: $' . $row['Amount'] . '</center>';
} else {
    echo '<center><span style="color:blue;">  Your Total Expense: $0.</span></center>';
}

// Handle form submission
if (isset($_GET['expense']) && isset($_GET['expense-category'])) {

    $expense = $_GET["expense"];
    $category = $_GET['expense-category'];
    $query="SELECT `$category` FROM `budgettable` WHERE UserName='$username'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $budgetremaining = $row[$category];
    if($expense >  $budgetremaining)
    {
        echo '<center><span style="color:red;">  Your Budget for this category doesnot allow this much expense.(Incase u want to update go and set budget for this category)</span></center>';
    }
    else
    {

        $date = date("Y-m-d");

        // Check if expense is greater than income
        $query = "SELECT `Amount` FROM `income` WHERE UserName='$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $income_inaccount = $row['Amount'];
            if ($expense > $income_inaccount) {
                echo '<center><span style="color:blue;">  Unsufficient Balance in your income.</span></center>';
            } else {

                $x=$budgetremaining-$expense;
                $query="UPDATE `budgettable` SET   `$category`='$x' WHERE UserName = '$username'";
                $conn->query($query);
                // Update expense amount
                $query = "SELECT Amount FROM expense WHERE UserName = '$username'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                $x = $expense + $row['Amount'];
                $query = "UPDATE `expense` SET `Amount`='$x' WHERE UserName = '$username'";
                $conn->query($query);
    
                // Insert expense detail
                $query = "INSERT INTO `expensedetail`(`UserName`, `DateEntry`, `Amount`, `Category`) VALUES ('$username','$date','$expense','$category')";
                $conn->query($query);
    
                // Update income amount
                $x = $income_inaccount - $expense;
                $query = "UPDATE `income` SET `Amount`='$x' WHERE UserName = '$username'";
                $conn->query($query);
            }
        } 
    }

   
}

// Close database connection
$conn->close();
?>

<!-- HTML code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
    <div class="navBar">
        <img class="logo" src="logo.png" alt="">
        <a href="main.php?username=<?php echo $username; ?>">Home</a>
        <a href="login.php">Log Out</a>
    </div>
    <div class="mainbox">
        <div class="sideBar">
            <b>User Name: </b>
            <span><b><?php echo $username; ?></b></span><br>
            <b>Dashboard</b><br>
            <b>Income Tracking</b>
            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $username; ?>">
                <input class="inputClass"  type="submit" value="View Income" name='viewinccheck'>
            </form>
            <?php
            if (isset($_GET['viewinccheck'])) {
                header("Location: Viewincome.php?username=" . urlencode($username));
                exit;
            }
            ?>
            <form action="Addincome.php" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $username; ?>">
                <input class="inputClass"  type="submit" value="Add Income" name='incomecheck'>
            </form>
            <?php
            if (isset($_GET['incomecheck'])) {
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
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $username; ?>">
                <input class="inputClass"  type="submit" value="Add Expense" name='expensecheck'>
            </form>
            <?php
            if (isset($_GET['expensecheck'])) {
                header("Location: Addexpense.php?username=". urlencode($username));
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
            <div class="inp">
            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $username;?>">
                <input class="inputClass"  class="income" type="text" id="incomeInput" placeholder="Type Expense" name="expense">
                <label for="expense-category">Category:</label>
                <select id="expense-category" name="expense-category">
                    <option value="">Select a category</option>
                    <option value="Grocery">Grocery</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Education">Education</option>
                    <option value="food">Food</option>
                    <option value="transportation">Transportation</option>
                    <option value="entertainment">Entertainment</option>
                    <option value="other">Other</option>
                </select>
                <br>
                <input class="inputClass"  type="submit" value="Add Expense">
            </form>
            </div>
            
        </div>
    </div>
</body>
</html>