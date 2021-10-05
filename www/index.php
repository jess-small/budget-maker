<?php

$db_host   = 'budget-maker-db.cn792cjf8ocy.us-east-1.rds.amazonaws.com';
$db_name   = 'budget-maker-db';
$db_user   = 'admin';
$db_passwd = '349-assign2';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5"></b>Budget Maker</h1>
    <p>
        <a href="/webpages/login.php" class="btn btn-warning">Login</a>
        <a href="/webpages/signup.php" class="btn btn-danger ml-3">Sign Up</a>
    </p>
</body>
</html>
