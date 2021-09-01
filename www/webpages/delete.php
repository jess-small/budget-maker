<?php
session_start();
$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);


if(isset($_GET['budget_id'])) {

    $budget_id = $_GET['budget_id'];

    $stmt = $pdo->prepare("DELETE FROM budget WHERE budget_id = :budget_id");
    $stmt->bindParam(':budget_id', $budget_id, PDO::PARAM_INT);
    $stmt->execute(); 
    header("location: budget.php");
    $stmt->close();
    //header("location: budget.php");	
}
?>
