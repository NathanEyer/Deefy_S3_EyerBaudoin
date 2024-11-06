<?php

namespace iutnc\deefy\action;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\repository\DeefyRepository;

class DelPlaylistAction extends Action
{

    public function execute(): string
    {
        //Vérifie que le nom est acceptable
        $nom = filter_input(INPUT_POST, 'nom_playlist_sup', FILTER_DEFAULT);

        $r = DeefyRepository::getInstance() ;

        //Crée la playlist
        $r->delPlaylistByName($nom);
        $_SESSION['playlist'] = null;

        return "Playlist $nom supprimée";
    }
}