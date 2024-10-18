<?php

require_once 'src/vendor/autoload.php';
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\exception\InvalidPropertyValueException;

session_start();

if (isset($_SESSION['playlist'])) {
    $piste1 = new AlbumTrack("Blinding Lights", "resources/Blinding_Lights.mp3");
    $piste1->setAlbum("After Hours");
    $piste1->setArtist("The Weeknd");
    $piste1->setSort("Pop");
    $piste1->setTrackNumber(1);
    $piste1->setYear(2020);
    try {
        $piste1->setTime(194);
    } catch (InvalidPropertyValueException $e) {
        print $e;
    }

    $_SESSION['playlist']->addTrack($piste1);
} else {
    echo "<p>Playlist inexistante</p>";
}
