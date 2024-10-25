<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\exception\InvalidPropertyValueException;

class AddPodcastTrackAction extends Action
{
    public function execute(): string
    {
        session_start();

        if(!isset($_SESSION['playlist'])) {return "Playlist inexistante";}

        if(!isset($_SESSION['inconnu'])) {$_SESSION['inconnu'] = 0;}

        $title = $_POST["title"] ?? 'inconnu'.++$_SESSION['inconnu'];
        $fileName = $_POST['fileName'] ?? 'resources/default.mp3';
        $artist = $_POST['artist'] ?? 'Artiste inconnu';
        $year = $_POST['year'] ?? 'Année inconnue';
        $time = $_POST['time'] ?? '0';
        $sort = $_POST['sort'] ?? 'Podcast';

        $piste = new PodcastTrack($title, $artist, $sort, $time, $fileName, $year);

        $_SESSION['playlist']->addTrack($piste);
        return "<p>PodcastTrack '$title' ajouté à la playlist</p>";
    }
}