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
<div id="temperature_chart"></div>
<div id="humidity_chart"></div>
<script>
    var parseTemperature = function (value, state) {
        if (state.colNum === 1) {
            return new Date(value * 1000);
        }
        if (state.colNum === 3) {
            return false;
        }
        return parseFloat(value);
    };
    var parseHumidity = function (value, state) {
        if (state.colNum === 1) {
            return new Date(value * 1000);
        }
        if (state.colNum === 2) {
            return false;
        }
        return parseFloat(value);
    };

    var drawTimelineChart = function (data, title, valueName, chartElement, color, format) {
        var options = {
            title: title,
            legend: "top",
            height: 400,
            colors: [color],
            pointSize: 2
        };
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn("datetime", "Date");
        dataTable.addColumn("number", valueName);
        dataTable.addRows(data);

        var chart = new google.visualization.LineChart(chartElement);
        chart.draw(dataTable, options);
    };

    google.charts.load("current", {
        callback: function () {


            $.get("logs.csv", function (csv) {
                var temperatureData = $.csv.toArrays(csv, {separator: ";", onParseValue: parseTemperature});
                drawTimelineChart(temperatureData, "Temperature over time", "Temperature °C", document.getElementById("temperature_chart"), "#c14e09");

                var humidityData = $.csv.toArrays(csv, {separator: ";", onParseValue: parseHumidity});
                drawTimelineChart(humidityData, "Relative humidity over time", "Relative humidity %", document.getElementById("humidity_chart"), "#006dc1");
            });
        },
        packages: ["corechart"]
    });
</script>
</body>
</html>
