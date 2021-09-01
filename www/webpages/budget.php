<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
	 <a href="create_budget.php" class="btn btn-warning">Create a budget</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    <h1>Budget test page</h1>

    <p>Showing contents of budget table:</p>

    <table border="1" class="table table-striped" style="table-layout: fixed">
    <tr><th>Budget Name</th><th>Budget Type</th><th>Starting Value</th><th>Edit Budget</th></tr>
    <?php
 
	$db_host   = '192.168.2.12';
	$db_name   = 'fvision';
	$db_user   = 'webuser';
	$db_passwd = 'insecure_db_pw';

	$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

	$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);
	$user_id = $_SESSION["uid"];
	

	// Prepare an insert statement
        $sql = "SELECT budget_id, budget_name, budget_type, starting_value FROM budget WHERE user_id = :user_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->execute();
	$budgets = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($budgets as $row){
	    echo "<tr><td>".$row["budget_name"]."</td><td>".$row["budget_type"]."</td><td>".$row["starting_value"]."</td><td><a href='delete.php?budget_id'>Delete</a></td></tr>\n";
	                  
	}

	

	




	?>
</table>

</body>
</html>
