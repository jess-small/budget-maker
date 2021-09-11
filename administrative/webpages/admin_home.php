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
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Budget Maker Administration.</h1>
    <p>
	 <a href="create_user.php" class="btn btn-warning">Create a regular user account</a>
     <a href="create_admin.php" class="btn btn-warning">Create an admin account</a>
    </p>
    <h3>Admin Accounts</h3>

    <table border="1" class="table table-striped" style="table-layout: fixed">
    <tr><th>User ID</th><th>Username</th><th>Manage Account</th></tr>
    
    <?php
 
	$db_host   = '192.168.2.12';
	$db_name   = 'fvision';
	$db_user   = 'webuser';
	$db_passwd = 'insecure_db_pw';

	$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

	$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

	

	// Prepare an insert statement
    $sql = "SELECT username, uid FROM administrator";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
    if(!$admins.sizeof() == 0){

    
	foreach($admins as $row){
            echo "<tr>";
            echo "<td>" . $row['uid'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td><a href='delete_account.php?uid=".$row['uid']."'>Delete Account</a></td>";
            echo "</tr>";
        }
    }else{
        echo "There are no admins";
    }

    



	?>
    

    </table>
    <h3>User Accounts</h3>
    <table border="1" class="table table-striped" style="table-layout: fixed">
    <tr><th>User ID</th><th>Username</th><th>Manage Account</th></tr>
    <?php
    $sql1 = "SELECT username, uid FROM user";
	$stmt = $pdo->prepare($sql1);
	$stmt->execute();
	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$users.sizeof() == 0){

    
        foreach($users as $row){
                echo "<tr>";
                echo "<td>" . $row['uid'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td><a href='delete_user.php?uid=".$row['uid']."'>Delete Account</a></td>";
                echo "</tr>";
            }
        }else{
            echo "There are no user accounts";
        }
    
    
    
    
    ?>
    </table>
    <p><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a></p>
  </body>
</html>
