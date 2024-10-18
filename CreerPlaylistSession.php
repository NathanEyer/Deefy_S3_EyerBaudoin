<?php

require_once 'src/vendor/autoload.php';
session_start();

if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = new iutnc\deefy\audio\lists\Playlist("feur");
} else {
    echo "<p>Playlist déjà existante</p>";
}
