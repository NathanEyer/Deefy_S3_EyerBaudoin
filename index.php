<?php
session_start();
require_once 'src/vendor/autoload.php';
use iutnc\deefy\dispatch\Dispatcher ;
use iutnc\deefy\repository\DeefyRepository ;

try {
    DeefyRepository::setConfig('src/configdb.ini');
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}

$d = new Dispatcher() ;
$d->run();
?>

