<?php
//connect to the database
$db_host   = 'budget-maker-db.cn792cjf8ocy.us-east-1.rds.amazonaws.com';
$db_name   = 'budget-maker';
$db_user   = 'admin';
$db_passwd = 'password';

$pdo_dsn = "mysql:host=$db_host;port=3306;dbname=$db_name";

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
    <h1 class="my-5"></b>Budget Maker Admin Server</h1>
    <p>
        <a href="/webpages/login.php" class="btn btn-warning">Login</a>
		<a href="/webpages/create_admin.php" class="btn btn-warning">Create Admin Account</a>
    </p>
</body>
</html>
