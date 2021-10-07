<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect then to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Budgets</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
	.wrapper{max-width: 500px; margin: auto; padding: 50px; display: block;}
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Budget Maker.</h1>
    <p>
	 <a href="create_budget.php" class="btn btn-warning">Create a budget</a>
    </p>
    <h2>All Budgets</h2>

    <table border="1" class="table table-striped" style="table-layout: fixed">
    <tr><th>Budget Name</th><th>Budget Type</th><th>Current Value</th><th>Edit Budget</th></tr>
    <?php
    //connect to the database
    $db_host   = 'budget-maker-db.cn792cjf8ocy.us-east-1.rds.amazonaws.com';
    $db_name   = 'budget-maker';
    $db_user   = 'admin';
    $db_passwd = 'password';

    $pdo_dsn = "mysql:host=$db_host;port=3306;dbname=$db_name";

	$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);
	$user_id = $_SESSION["uid"];
	

	// Prepare a select statement to avoid SQL injection
    $sql = "SELECT budget_id, budget_name, budget_type, starting_value FROM budget WHERE user_id = :user_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->execute();
	$budgets = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
    //checks if usesr has any budgets made
    if(!$budgets.sizeof() == 0){
        //if so display all budgets
        foreach($budgets as $row){
                echo "<tr>";
                echo "<td>" . $row['budget_name'] . "</td>";
                echo "<td>" . $row['budget_type'] . "</td>";
                echo "<td>$" . $row['starting_value'] . "</td>";
                echo "<td><a href='add_expense.php?budget_id=".$row['budget_id']."'>Add Expense</a><br></br><a href='delete.php?budget_id=".$row['budget_id']."'>Delete Budget</a><br></br><a href='expenses.php?budget_id=".$row['budget_id']."'>View Expenses</a></td>";
                echo "</tr>";
         
            }
            //if not 
    }else{
        echo "You have no budgets";
    }


	?>
    </table>
    <p><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a></p>
  </body>
</html>