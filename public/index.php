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
    google.charts.load("current", {
        callback: function () {
            var options = {
                title: "Temperature",
                curveType: "function",
                legend: { position: "bottom" }
            };

            $.get("logs.csv", function (csvString) {
                var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

                var data = new google.visualization.arrayToDataTable(arrayData);

                var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
                chart.draw(data);
            });
        },
        packages: ["corechart"]
    });
</script>
Hello World!<br/>
<?php
$file = fopen("logs.csv", "r");
print_r(fgetcsv($file));
fclose($file);
?>
</body>
</html>
