<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="common.css">


    <?php
        if(isset($_GET['budgetview']))
            {
                $username = $_GET['username'];
                header("Location: Viewbudget.php?username=". urlencode($username));
                exit;
            }
            
           ?>

<?php
        if(isset($_GET['budgetcheck']))
            {
                $username = $_GET['username'];
                header("Location: Setbudget.php?username=". urlencode($username));
                exit;
            }
            
           ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    <?php
    $username = $_GET['username'];
    $conn = new mysqli('localhost', 'root', '', 'budget management');

    // Get expense data
    $query = "SELECT DateEntry, SUM(Amount) AS TotalAmount FROM expensedetail WHERE UserName='$username' GROUP BY DateEntry";
    $result = $conn->query($query);
    $expense_data = array();
    while ($row = $result->fetch_assoc()) {
        $expense_data[] = array($row["DateEntry"], $row["TotalAmount"]);
    }

    // Get income data
    $query = "SELECT DateEntry, SUM(Amount) AS TotalAmount FROM incomedetail WHERE UserName='$username' GROUP BY DateEntry";
    $result = $conn->query($query);
    $income_data = array();
    while ($row = $result->fetch_assoc()) {
        $income_data[] = array($row["DateEntry"], $row["TotalAmount"]);
    }

    $conn->close();
 ?>

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Date');
      data.addColumn('number', 'Expenses');
      data.addColumn('number', 'Income');

      // Add expense and income data
      <?php foreach ($expense_data as $expense) {?>
        data.addRow(['<?php echo $expense[0];?>', <?php echo $expense[1];?>, null]);
      <?php }?>
      <?php foreach ($income_data as $income) {?>
        data.addRow(['<?php echo $income[0];?>', null, <?php echo $income[1];?>]);
      <?php }?>

      var options = {
        chart: {
          title: 'Expenses and Income Over Time'
        },
        width: 900,
        height: 500,
        hAxis: {
          title: 'Date'
        },
        vAxis: {
          title: 'Amount'
        },
        series: {
          0: {targetAxisIndex: 0}, // Expenses
          1: {targetAxisIndex: 0} // Income
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('line_top_x'));

      chart.draw(data, options);
    }
  </script>

  








    






















    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      <?php
      $username = $_GET['username'];
      $conn = new mysqli('localhost', 'root', '', 'budget management');
      $query = "SELECT Category, SUM(Amount) AS TotalAmount FROM expensedetail WHERE UserName='$username' GROUP BY Category";
      $result = $conn->query($query);
      $category_amounts = array();
      while ($row = $result->fetch_assoc()) {
          $category_amounts[] = array($row["Category"], $row["TotalAmount"]);
      }
      $conn->close();
     ?>

      function drawChart() {
          var data = google.visualization.arrayToDataTable([
              ['Category', 'Expenses'],
              <?php foreach ($category_amounts as $category_amount) {?>
                  ['<?php echo $category_amount[0];?>', <?php echo $category_amount[1];?>],
              <?php }?>
          ]);

          var options = {
              title: 'My Expenses'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
      }
    </script>

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
            
         if(isset($_GET['username'])){
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



            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <input class="inputClass"  type="submit" value="Add Income" name='incomecheck'>
            </form>
            <?php

        if(isset($_GET['incomecheck']))
            {
                $username = $_GET['username'];
                header("Location: Addincome.php?username=". urlencode($username));
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

            <form action="" method='GET'>
                <input class="inputClass"  type="hidden" name="username" value="<?php echo $_GET['username'];?>">
                <input class="inputClass"  type="submit" value="Add Expense" name='expensecheck'>
            </form>
            <?php
        if(isset($_GET['expensecheck']))
            {
                $username = $_GET['username'];
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
           
            
        </div>
        <div class="rightmainbox">

        <?php
$conn = new mysqli('localhost','root','','budget management');
$username = $_GET['username'];
$query = "SELECT Amount FROM income WHERE UserName = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<center><span style="color:green;"> Your Income: $' . $row['Amount'] . '</center>';
} else {
    echo '<center><span style="color:red;">  Your Income: $0.</span></center>';
}

$query = "SELECT Amount FROM expense WHERE UserName = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<center><span style="color:green;"> Your Expense: $' . $row['Amount'] . '</center>';
} else {
    echo '<center><span style="color:red;">  Your Expense: $0.</span></center>';
}

$conn->close();
?>
       


        <div id="piechart"></div>
        <div id="line_top_x"></div>


        
    </div>
    

    </div>
</body>
</html>