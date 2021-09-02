<?php
session_start();
$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

// Define variables and initialize with empty values
$expense_name = $description = $updated_value = $amount = "";
$expense_name_err = $description_err = $amount_err = "";


//$budget_id = $_GET['budget_id'];
//$_SESSION['b_id'] = $budget_id;

echo $budget_id;


//if(isset($_POST['submit'])) {
  if($_SERVER["REQUEST_METHOD"] == "POST"){  

    $budget_id= $_SESSION['b_id'];  
    $expense_name = $_POST['expense_name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $sql = "UPDATE budget SET starting_value=:amount WHERE budget_id=:budget_id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":amount", $amount, PDO::PARAM_INT);
    $stmt->bindParam(":budget_id", $budget_id, PDO::PARAM_INT);
    if($stmt->execute()){
 	header("location: budget.php");
	}else{
	echo 'error';
	
	}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Expense</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{max-width: 500px; margin: auto; padding: 50px; display: block;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Add Expense</h2>
        <p>Enter details.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="input">
            <div class="form-group">
                <label>Expense Name</label>
                <input type="text" name="expense_name" class="form-control" value="<?php echo $expense_name; ?>">
		<span class="invalid-feedback"><?php echo $expense_name_err; ?></span>
            </div>
	    <div class = "form-group">
            <label>Expense Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
		<span class="invalid-feedback"><?php echo $description_err; ?></span>
	    </div>
	    <div class="form-group">
                <label>Expense Amount</label>
                <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
		<span class="invalid-feedback"><?php echo $amount_err; ?></span>
            </div>           
          
           <input type="submit" name="submit" class="btn btn-primary" value="Update">
        <a href="budget.php" class="btn btn-warning">Back</a>
        </form>
    </div>
</body>
<html>
