<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deefy</title>
</head>
<body>

<div style="background-color: #007bff; padding: 15px; text-align: center; color: white;">
    <a href="index.php" style="margin: 0 15px; color: white; text-decoration: none;">Page d'accueil</a>
    <a href="index.php?action=show-playlist" style="margin: 0 15px; color: white; text-decoration: none;">Afficher la playlist courante</a>
    <a href="index.php?action=show-playlists" style="margin: 0 15px; color: white; text-decoration: none;">Afficher toutes les playlists</a>
    <a href="index.php?action=show-tracks" style="margin: 0 15px; color: white; text-decoration: none;">Afficher tous les tracks</a>
    <a href="index.php?action=show-podcasts" style="margin: 0 15px; color: white; text-decoration: none;">Afficher tous les podcasts</a>
    <a href="index.php?action=signin" style="margin: 0 15px; color: white; text-decoration: none;">S\'inscrire</a>
    <a href="index.php?action=login" style="margin: 0 15px; color: white; text-decoration: none;">Se connecter</a>
    <a href="index.php?action=logout" style="margin: 0 15px; color: white; text-decoration: none;">Se déconnecter</a>
</div>

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
