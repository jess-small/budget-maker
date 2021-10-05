<?php
session_start();
//connect to the database
$db_host   = 'budget-maker-db.cn792cjf8ocy.us-east-1.rds.amazonaws.com';
$db_name   = 'budget-maker-db';
$db_user   = 'admin';
$db_passwd = '349-assign2';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

//get the user ID from the URL
if(isset($_GET['uid'])) {
    //set the user ID from the URL
    $uid = $_GET['uid'];
    //prepare a delete statement to avoid SQL injection
    $sql = "DELETE FROM administrator WHERE uid = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $stmt->execute(); 
    //reload the page
    header("location: admin_home.php");
    $stmt->close();
    	
}
?>
