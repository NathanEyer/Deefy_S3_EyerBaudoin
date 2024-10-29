<?php
declare(strict_types = 1);

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\PodcastTrack;

class AddPodcastTrackAction extends Action
{
    public function execute(): string
    {
        //Vérifie l'existence de playlists
        if(empty($_SESSION['playlists'])) {return "Playlist inexistante";}

        $playlist = end($_SESSION['playlists']);

        //Nettoye chaque valeurs donnés dans le formulaire
        $title = filter_input(INPUT_POST, 'podcast-title', FILTER_SANITIZE_STRING);
        $fileName = filter_input(INPUT_POST, 'podcast-fileName', FILTER_SANITIZE_STRING);
        $artist = filter_input(INPUT_POST, 'podcast-artist', FILTER_SANITIZE_STRING);
        $year = filter_input(INPUT_POST, 'podcast-year', FILTER_SANITIZE_STRING);
        $sort = filter_input(INPUT_POST, 'podcast-sort', FILTER_SANITIZE_STRING);
        $time = filter_input(INPUT_POST, 'podcast-time', FILTER_SANITIZE_STRING);

        //Crée le podcast
        $piste = new PodcastTrack($title, $artist, $sort, $time, $fileName, $year);

        //Ajoute
        end($_SESSION['playlists'])->addTrack($piste);
        return "PodcastTrack '$title' ajouté à la playlist";
    }
}