<?php
declare(strict_types = 1);

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\repository\DeefyRepository;

class AddAlbumTrackAction extends Action
{
    public function execute(): string{
        //Vérifie l'existence de playlists
        if(empty($_SESSION['playlist'])) {return "Playlist inexistante";}

        //Nettoye chaque valeurs donnés dans le formulaire
        $title = filter_input(INPUT_POST, 'album-title', FILTER_DEFAULT);
        $fileName = filter_input(INPUT_POST, 'album-fileName', FILTER_DEFAULT);
        $artist = filter_input(INPUT_POST, 'album-artist', FILTER_DEFAULT);
        $year = filter_input(INPUT_POST, 'album-year', FILTER_DEFAULT);
        $sort = filter_input(INPUT_POST, 'album-sort', FILTER_DEFAULT);
        $time = filter_input(INPUT_POST, 'album-time', FILTER_DEFAULT);
        $trackNumber = filter_input(INPUT_POST, 'album-trackNumber', FILTER_DEFAULT);
        $album = filter_input(INPUT_POST, 'album', FILTER_DEFAULT);
        $playlist = filter_input(INPUT_POST, 'album-playlist', FILTER_DEFAULT);

        //Crée le podcast
        $piste = new AlbumTrack(0, $title, $artist, $sort, (int)$time, $fileName, $year, $album, (int)$trackNumber);

        //Ajoute
        $r = DeefyRepository::getInstance() ;
        $r->addTrackPlaylist($playlist, $piste);
        $r->saveTrack($piste);

        return "AlbumTrack '$title' ajouté à la playlist";
    }
}