<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\AlbumTrack;

class AddAlbumTrackAction extends Action
{

    public function execute(): string
    {
        //Vérifie l'existence de playlists
        if(empty($_SESSION['playlists'])) {return "Playlist inexistante";}

        $playlist = end($_SESSION['playlists']);

        //Nettoye chaque valeurs donnés dans le formulaire
        $title = filter_input(INPUT_POST, 'album-title', FILTER_SANITIZE_STRING);
        $fileName = filter_input(INPUT_POST, 'album-fileName', FILTER_SANITIZE_STRING);
        $artist = filter_input(INPUT_POST, 'album-artist', FILTER_SANITIZE_STRING);
        $year = filter_input(INPUT_POST, 'album-year', FILTER_SANITIZE_STRING);
        $sort = filter_input(INPUT_POST, 'album-sort', FILTER_SANITIZE_STRING);
        $time = filter_input(INPUT_POST, 'album-time', FILTER_SANITIZE_STRING);
        $trackNumber = filter_input(INPUT_POST, 'album-trackNumber', FILTER_SANITIZE_STRING);
        $album = filter_input(INPUT_POST, 'album', FILTER_SANITIZE_STRING);

        //Crée le podcast
        $piste = new AlbumTrack($title, $artist, $sort, $time, $fileName, $year, $album, $trackNumber);

        //Ajoute
        end($_SESSION['playlists'])->addTrack($piste);
        return "AlbumTrack '$title' ajouté à la playlist";
    }
}