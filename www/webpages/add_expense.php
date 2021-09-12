<?php
/* CODE SOURCED FROM https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php MODIFIED TO CREATE EXPENSE RATHER THAN LOGIN TO AN ACCOUNT */

session_start();
//connect to the database
$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

// Define variables and initialize with empty values
$expense_name = $description = $updated_value = $amount = "";
$expense_name_err = $description_err = $amount_err = "";

//gets budget_id from url and sets in session storage
if (isset($_GET["budget_id"])) {
    $_SESSION["b_id"] = $_GET["budget_id"];
}
$b_id = $_SESSION["b_id"];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){  
	
    //checks if expense field has input
    if(empty(trim($_POST["expense_name"]))){
        $expense_name_err = "Please enter an expense name.";
    } else{
        $expense_name = trim($_POST["expense_n oame"]);
    }
    //checks if description field has input
    if(empty(trim($_POST["description"]))){
        $description_err = "Please enter a description.";
    } else{
        $description = trim($_POST["description"]);
    }

    //checks if amount field has input and is of correct type
    if(empty(trim($_POST["amount"]))){
        $amount_err = "Please enter an amount.";

     } elseif(!preg_match('/^([0-9]*)$/', trim($_POST["amount"]))){
        $amount_err = "Enter a valid amount";
    } else{
        $amount = trim($_POST["amount"]);
    }

   

    
    //checks if there are not errors in form, if not statements will execute
    if(empty($expense_name_err) && empty($description_err) && empty($amount_err)){

        //prepare an insert statement to insert into expense table
        $sql = "INSERT INTO expense (expense_name, description, amount, b_id) VALUES (:expense_name, :description, :amount, :b_id)";
        $stmt = $pdo->prepare($sql);
        //bind variables to statement
        $stmt->bindParam(":expense_name", $expense_name, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":amount", $amount, PDO::PARAM_INT);
        $stmt->bindParam(":b_id", $b_id, PDO::PARAM_INT);
   
        //if successful redirect to budget homepage
        if($stmt->execute()){
 	        header("location: budget.php");
	    }else{
	        echo 'error';
	
	    }

        //statement to select the original value of the budget from the budget table
        $sql1 = "SELECT starting_value FROM budget WHERE budget_id = :b_id";
        $stmt = $pdo->prepare($sql1);
        $stmt->bindParam(':b_id', $b_id, PDO::PARAM_INT);
        $stmt->execute();
        $budgets = $stmt->fetch();
	
        //gets original value of budget
	    $original_value = $budgets['starting_value'];

        //sets new value of budget to the origin value minus the amount of the expense
        if(($budgets['starting_value'] - $amount) > 0){
            $new_value = $budgets['starting_value'] - $amount;
        }else{
            $new_value = 0;
        }
            

   
        //statement to update the original value of the budget to the updated value
        $sql2 = "UPDATE budget SET starting_value=:new_value WHERE budget_id=:b_id";
        //prepare the update statement
        $stmt = $pdo->prepare($sql2);
        //bind parameters 
        $stmt->bindParam(":new_value", $new_value, PDO::PARAM_INT);
        $stmt->bindParam(":b_id", $b_id, PDO::PARAM_INT);
        if($stmt->execute()){
            header("location: budget.php");
        }else{
            echo 'error';	
	   }   
       
    }
    unset($pdo);
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
                <input type="text" name="expense_name" class="form-control <?php echo (!empty($expense_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $expense_name; ?>">
		        <span class="invalid-feedback"><?php echo $expense_name_err; ?></span>
            </div>
	    <div class = "form-group">
            <label>Expense Description</label>
                <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
		        <span class="invalid-feedback"><?php echo $description_err; ?></span>
	    </div>
	    <div class="form-group">
                <label>Expense Amount</label>
                <input type="text" name="amount" class="form-control <?php echo (!empty($amount_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $amount; ?>">
		       <span class="invalid-feedback"><?php echo $amount_err; ?></span>
            </div>           
          
           <input type="submit" name="submit" class="btn btn-primary" value="Update">
        <a href="budget.php" class="btn btn-warning">Back</a>
        </form>
    </div>
</body>
<html>
