<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Garten</title>
</head>
<body>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
<div id="chart_div"></div>
<script>
google.charts.load('current', {
  callback: function () {
    csvString = 'Site,Janvier,Février,Mars,Avril,Mai,Juin,Juillet,Août,Septembre,Octobre,Novembre,Décembre\nCITROEN VILLEFRANCHE CARROSSERIE,0,0,14,0,18,21,0,0,0,0,0,0\nCITROEN VILLEFRANCHE ,240,237,230,264,219,285,219,130,4,0,0,0\nNISSAN VILLEFRANCHE ,174,202,215,181,196,244,203,107,10,1,0,0';

    var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

    var data = new google.visualization.arrayToDataTable(arrayData);
    
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data);
  },
  packages: ['corechart']
});
</script>
Hello World!<br/>
<?php
$file = fopen("../logs.csv", "r");
print_r(fgetcsv($file));
fclose($file);
?>
</body>
</html>
