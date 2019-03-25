<?php
if (isset($_GET["timestamp"]) && isset($_GET["label"]) && isset($_GET["description"])) {
    $file = "../labeldata.csv";
    $line = $_GET["timestamp"] . ";" . $_GET["label"] . ";" . $_GET["description"] . "\n";
    $fh = fopen($file, "a") or die("Can't open file");
    fwrite($fh, $line);
    fclose($fh);
    echo "Added " . $line;
}