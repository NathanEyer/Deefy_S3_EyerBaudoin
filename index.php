<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deefy</title>
</head>
<body>
    <a href="index.php?action=playlist">button</a>
    <a href="index.php?action=add-playlist">add-playlist</a>


<?php
require_once 'src/vendor/autoload.php';
use iutnc\deefy\dispatch\Dispatcher ;

$d = new Dispatcher() ;
$d->run();

?>

</body>
</html>
