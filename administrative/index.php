<?php

session_start();

$db_host   = '192.168.2.12';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);


$query="SELECT expense_name, amount FROM expense";
$step=$dbo->prepare($query);
if($step->execute()){
$php_data_array=$step->fetchAll();
echo "<script>
var my_2d=".json_encode($php_data_array)."
</script>"

}else{
    print_r($step->errorInfo());
}

unset($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
   <title>Pie Chart</title>
</head>
<body>
 

<div id="chart_div"></div>
<br><br> 
<a href=https://www.plus2net.com/php_tutorial/chart-database.php>Pie Chart
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(draw_my_chart);
   function draw_my_chart(){
       var data = new google.visualization.DataTable();
       data.addColumn('string', 'expense_name')
       data.addColumn('number', 'amount')
       for(i-0; i<my_2d.length; i++)
       data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
       
// above row adds the JavaScript two dimensional array data into required chart format
var options = {title:'plus2net.com : How the tutorials are distributed',
                 width:600,
                 height:500,
             };
             var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
  chart.draw(data, options);

   }
</script>

</html>
 