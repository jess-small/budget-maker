<?php

// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect then to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//set the session ID to the budget ID
if (isset($_GET["budget_id"])) {
    $_SESSION["b_id"] = $_GET["budget_id"];
}
$b_id = $_SESSION["b_id"];



?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
	.wrapper{max-width: 500px; margin: auto; padding: 50px; display: block;}
    </style>

</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Budget Maker.</h1>
  
    <h2>Expenses</h2>

    <table border="1" class="table table-striped" style="table-layout: fixed">
    <tr><th>Expense Name</th><th>Description</th><th>Amount</th></tr>

    
    <?php
    // connect to the database
    $db_host   = 'budget-maker-db.cn792cjf8ocy.us-east-1.rds.amazonaws.com';
    $db_name   = 'budget-maker-db';
    $db_user   = 'admin';
    $db_passwd = '349-assign2';

	$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

	$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);
	//$user_id = $_SESSION["uid"];
	
	// Prepare a select statement to avoid SQL injection
    $sql = "SELECT expense_id, expense_name, description, amount FROM expense WHERE b_id = :b_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':b_id', $b_id, PDO::PARAM_INT);
	$stmt->execute();
	$expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
    // loops through the array to fill the table
	foreach($expenses as $row){
            echo "<tr>";
            echo "<td>" . $row['expense_name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "</tr>";
        }

	?>
    
    </table>
    <p><a href="budget.php" class="btn btn-warning">Back</a><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a></p>
  </body>
</html>