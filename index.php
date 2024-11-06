<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deefy</title>
</head>
<body>

<li><a href="index.php">Page d'accueil</a></li>

<?php
session_start();

require_once 'src/vendor/autoload.php';
use iutnc\deefy\dispatch\Dispatcher ;
use iutnc\deefy\repository\DeefyRepository ;


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

DeefyRepository::setConfig('src/configdb.ini');

$d = new Dispatcher() ;
$d->run();

?>

</body>
</html>
