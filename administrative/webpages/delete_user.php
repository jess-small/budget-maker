<?php
session_start();
$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);


if(isset($_GET['uid'])) {

    $uid = $_GET['uid'];
    $sql = "DELETE FROM user WHERE uid = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
    $stmt->execute(); 
    header("location: admin_home.php");
    $stmt->close();
    	
}
?>
