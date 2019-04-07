<?php
if (isset($_GET["timestamp"]) && isset($_GET["label"])) {
    $timestamp = $_GET["timestamp"];
    $label = $_GET["label"];
    if ($timestamp == null) {
        $rows = file(__DIR__ . "/../sensordata.csv");
        $last_row = array_pop($rows);
        $data = str_getcsv($last_row, ";");
        $timestamp = $data[0];
    }
    $file = __DIR__ . "/../labeldata.csv";
    $line = $timestamp . ";" . $label . "\n";
    $fh = fopen($file, "a") or die("Can't open file");
    fwrite($fh, $line);
    fclose($fh);
    echo "Added " . $line;
}