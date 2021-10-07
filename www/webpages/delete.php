<?php
session_start();
//connect to the database
$db_host   = 'budget-maker-db.cn792cjf8ocy.us-east-1.rds.amazonaws.com';
$db_name   = 'budget-maker';
$db_user   = 'admin';
$db_passwd = 'password';

$pdo_dsn = "mysql:host=$db_host;port=3306;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);



//check if budget ID is set in URL
if(isset($_GET['budget_id'])) {
    //get and set budget ID from URL
    $budget_id = $_GET['budget_id'];
    //prepare a delete statement
    $sql = "DELETE FROM budget WHERE budget_id = :budget_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
    $stmt->execute();
    //reload page
    header("location: budget.php"); 
    $stmt->close();
    
    	
}
?>
