<?php
if (isset($_GET["timestamp"]) && isset($_GET["label"])) {
    $file = __DIR__ . "/../labeldata.csv";
    $line = $_GET["timestamp"] . ";" . $_GET["label"] . "\n";
    $fh = fopen($file, "a") or die("Can't open file");
    fwrite($fh, $line);
    fclose($fh);
    echo "Added " . $line;
}