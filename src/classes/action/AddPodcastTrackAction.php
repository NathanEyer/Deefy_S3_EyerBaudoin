<?php
declare(strict_types = 1);

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\repository\DeefyRepository;

class AddPodcastTrackAction extends Action
{
    public function execute(): string
    {
        //Vérifie l'existence de playlists
        if(empty($_SESSION['playlist'])) {return "Playlist inexistante";}


        //Nettoye chaque valeurs donnés dans le formulaire
        $title = filter_input(INPUT_POST, 'podcast-title', FILTER_DEFAULT);
        $fileName = filter_input(INPUT_POST, 'podcast-fileName', FILTER_DEFAULT);
        $artist = filter_input(INPUT_POST, 'podcast-artist', FILTER_DEFAULT);
        $year = filter_input(INPUT_POST, 'podcast-year', FILTER_DEFAULT);
        $sort = filter_input(INPUT_POST, 'podcast-sort', FILTER_DEFAULT);
        $time = filter_input(INPUT_POST, 'podcast-time', FILTER_DEFAULT);
        $playlist = filter_input(INPUT_POST, 'podcast-playlist', FILTER_DEFAULT);

        //Crée le podcast
        $piste = new PodcastTrack(0, $title, $artist, $sort, (int)$time, $fileName, $year);


        $r = DeefyRepository::getInstance() ;
        $r->addTrackPlaylist($playlist, $piste);

        //Ajoute
        return "PodcastTrack '$title' ajouté à la playlist";
    }
}