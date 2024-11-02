<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deefy</title>
</head>
<body>

<?php

require_once 'src/vendor/autoload.php';
use iutnc\deefy\dispatch\Dispatcher ;
use iutnc\deefy\repository\DeefyRepository ;
session_start();

try{
    DeefyRepository::setConfig('src/configdb.ini') ;
    $d = new Dispatcher() ;
    $d->run();
} catch (\Exception $e){
    echo $e->getMessage() ;
}

?>

</body>
</html>
