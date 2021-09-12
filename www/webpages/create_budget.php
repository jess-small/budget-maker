<?php
session_start();
// Checks if user is logged in, if not redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//connect to the database
$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

/* CODE SOURCED FROM https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php ADAPTED TO BE FOR A BUDGET RATHER THAN TO LOGIN */

// Define variables and initialize with empty values
$budget_name = $budget_type = $starting_value = "";
$name_err = $type_err = $starting_value_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate budget name
    if(empty(trim($_POST["budget_name"]))){
        $name_err = "Please enter a budget name.";
    } elseif(!preg_match('/^[a-zA-Z0-9_ ]+$/', trim($_POST["budget_name"]))){
        $name_err = "Budget name can only contain letters, numbers, and underscores.";
    } else{
        $budget_name = trim($_POST["budget_name"]);
            $budget_name = trim($_POST["budget_name"]);

            unset($stmt);
        }


     // Ensure user has entered a budget name
    if(empty(trim($_POST["budget_type"]))){
        $type_err = "Please select a budget type.";
    } else{
        $budget_type = trim($_POST["budget_type"]);
    }

    // Validate starting value
     if(empty(trim($_POST["starting_value"]))){
        $starting_value_err = "Please enter a starting value.";

     } elseif(!preg_match('/^([0-9]*)$/', trim($_POST["starting_value"]))){
        $starting_value_err = "Enter a valid starting value";
    } else{
        $starting_value = trim($_POST["starting_value"]);
    }
    
    //set user id from the session
    $user_id = $_SESSION['uid'];

    // Check input errors before inserting in database
    if(empty($name_err) && empty($type_err) && empty($starting_value_err)){

        // Prepare an insert statement to avoid SQL injection
        $sql = "INSERT INTO budget (user_id, budget_name, budget_type, starting_value) VALUES (:user_id, :budget_name, :budget_type, :starting_value)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":budget_name", $budget_name, PDO::PARAM_STR);
            $stmt->bindParam(":budget_type", $budget_type, PDO::PARAM_STR);
	        $stmt->bindParam(":starting_value", $starting_value, PDO::PARAM_INT);
	        $stmt->bindParam(":user_id", $param_user_id, PDO::PARAM_INT);
            // Set parameters
            $param_budget_name = $budget_name;
            $param_budget_type = $budget_type;
	        $param_starting_value = $starting_value;
	        $param_user_id = $user_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to budget home page
                header("location: budget.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Budget</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
	.wrapper{max-width: 500px; margin: auto; padding: 50px; display: block;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Create a Budget</h2>
        <p>Enter details.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="input">
            <div class="form-group">
                <label>Budget Name</label>
                <input type="text" name="budget_name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $budget_name; ?>">
		<span class="invalid-feedback"><?php echo $name_err; ?></span>                
            </div>
            <div class="form-group">
                <label>Budget Type</label>
		<select name = "budget_type" id= "type" class="form-control <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $budget_type; ?>">
		  <option value = "Food">Personal</option>
		  <option value = "Housing">Housing</option>
		  <option value = "Bills">Bills</option>
		  <option value = "Savings">Savings</option>
                </select>
		<span class="invalid-feedback"><?php echo $type_err; ?></span>
            </div>
            <div class="form-group">
                <label>Starting Value $</label>
                <input type="text" name="starting_value" class="form-control <?php echo (!empty($starting_value_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $starting_value; ?>">
                <span class="invalid-feedback"><?php echo $starting_value_err; ?></span>
            </div>
           <input type="submit" class="btn btn-primary" value="Submit">
        <a href="budget.php" class="btn btn-warning">Back</a>
        </form>
    </div>
</body>
</html>


