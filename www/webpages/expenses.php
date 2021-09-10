<?php
// Source code for the pie chart format: https://canvasjs.com/php-charts/pie-chart/
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if (isset($_GET["budget_id"])) {
    $_SESSION["b_id"] = $_GET["budget_id"];
}
$b_id = $_SESSION["b_id"];


// // Prepare an insert statement
// $sql2 = "SELECT expense_id, expense_name, amount, b_id FROM expense WHERE b_id = :b_id";
// $stmt = $pdo->prepare($sql2);
// $stmt->bindParam(':b_id', $b_id, PDO::PARAM_INT);
// $stmt->execute();
// $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// if(!$expenses.sizeof() == 0){
//     $dataPoints = array( 
//     foreach($expenses as $row){
//     array("label"=>$row['expense_name'], "y"=>$row['amount']),
//     }
//     )
// }else{
// echo "You have no expenses";
// }

$dataPoints = array( 
	array("label"=>"retirement", "y"=>500),
	array("label"=>"short term", "y"=>200),
	array("label"=>"long term", "y"=>300),
)

// $dataArray = array();

// $qry = mysql_query("SELECT expense_name, amount FROM expense");

// while($row = mysql_fetch_array($qry)) {
//     $dataArray[$row['expense_name']] = $res['amount'];
// }


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

<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Your Budget Diagram"
	},
	data: [{
		type: "pie",
		indexLabel: "{label} ('$'{y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Budget Maker.</h1>
  
    <h2>Expenses</h2>

    <table border="1" class="table table-striped" style="table-layout: fixed">
    <tr><th>Expense Name</th><th>Description</th><th>Amount</th></tr>

    
    <?php
 
	$db_host   = '192.168.2.12';
	$db_name   = 'fvision';
	$db_user   = 'webuser';
	$db_passwd = 'insecure_db_pw';

	$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

	$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);
	$user_id = $_SESSION["uid"];
	

	// Prepare an insert statement
    $sql = "SELECT expense_id, expense_name, description, amount FROM expense WHERE b_id = :b_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':b_id', $b_id, PDO::PARAM_INT);
	$stmt->execute();
	$expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
	

	foreach($expenses as $row){
            echo "<tr>";
            echo "<td>" . $row['expense_name'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "</tr>";
        }

	?>
    
    </table>
    <br>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


    <p><a href="budget.php" class="btn btn-warning">Back</a><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a></p>
  </body>
</html>