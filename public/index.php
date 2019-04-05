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
<select id="marker">
    <option value="LD">Laundry Dry</option>
    <option value="OW">Open Window</option>
    <option value="CW">Close Window</option>
</select>
<button id="addmarker">Add marker</button>
<div id="temperature_chart"></div>
<div id="humidity_chart"></div>
<script>
    var addMarker = function (timestamp, label) {
        $.get("api.php", {timestamp: timestamp, label: label}, function (response) {
            console.log(response);
        });
    };

    var parseData = function (value, state) {
        if (state.colNum === 1)
            return new Date(value * 1000);
        if (state.colNum > 3)
            return value || null;
        return value ? parseFloat(value) : null;
    };
    var parseTemperature = function (value, state) {
        if (state.colNum === 3)
            return false;
        return parseData(value, state);
    };
    var parseHumidity = function (value, state) {
        if (state.colNum === 2)
            return false;
        return parseData(value, state);
    };

    var drawTimelineChart = function (data, title, valueName, chartElement, color) {
        var options = {
            title: title,
            legend: "top",
            height: 400,
            colors: [color],
            hAxis: {
                format: "HH:mm\ndd/MM/yyyy"
            }
        };
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn("datetime", "Date");
        dataTable.addColumn("number", valueName);
        dataTable.addColumn({type: "string", role: "annotation"});
        dataTable.addColumn({type: "string", role: "annotationText"});

        dataTable.addRows(data);

        var chart = new google.visualization.LineChart(chartElement);

        $("#addmarker").click(function () {
            var selection = chart.getSelection()[0];
            if (selection) {
                addMarker(data[selection.row][0].getTime() / 1000, $("#marker").val());
            }
        });

        function selectHandler() {

        }

        google.visualization.events.addListener(chart, "select", selectHandler);
        chart.draw(dataTable, options);
    };

    google.charts.load("current", {
        callback: function () {
            $.get("logs.csv", function (csv) {
                var temperatureData = $.csv.toArrays(csv, {
                    separator: ";",
                    onParseValue: parseTemperature
                });
                drawTimelineChart(
                    temperatureData,
                    "Temperature over time",
                    "Temperature °C",
                    document.getElementById("temperature_chart"),
                    "#c14e09"
                );

                var humidityData = $.csv.toArrays(csv, {
                    separator: ";",
                    onParseValue: parseHumidity
                });
                drawTimelineChart(
                    humidityData,
                    "Relative humidity over time",
                    "Relative humidity %",
                    document.getElementById("humidity_chart"),
                    "#006dc1"
                );
            });
        },
        packages: ["corechart"]
    });
</script>
</body>
</html>
