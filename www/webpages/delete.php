<?php
session_start();
//connect to the database
$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

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
