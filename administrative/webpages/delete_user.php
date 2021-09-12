<?php
session_start();
// connect to the database
$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

//get the user id from the URL
if(isset($_GET['uid'])) {
    //set the user id from the URL
    $uid = $_GET['uid'];

    //prepare a delete statement to avoid SQL injection
    $sql = "DELETE FROM user WHERE uid = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $stmt->execute(); 
    //reload page
    header("location: admin_home.php");
    $stmt->close();
    	
}
?>
