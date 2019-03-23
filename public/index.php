<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Garten</title>
</head>
<body>
Hello World!<br/>
<?php
$file = fopen("../logs.csv", "r");
print_r(fgetcsv($file));
fclose($file);
?>
</body>
</html>