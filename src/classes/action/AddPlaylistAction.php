<?php
declare(strict_types = 1);

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\repository\DeefyRepository;

class AddPlaylistAction extends Action
{
    public function execute(): string
    {
        //Vérifie que le nom est acceptable
        $nom = filter_input(INPUT_POST, 'nom', FILTER_DEFAULT);

        $r = DeefyRepository::getInstance() ;

        //Crée la playlist
        $playlist = new Playlist(0, $nom);
        $pl = $r->saveEmptyPlaylist($playlist);

        if($pl === null){
            return "Playlist déjà existante";
        }

        //Crée le tableau en sessions
        if(!isset($_SESSION['playlists'])) {
            $_SESSION['playlists'] = [];
        }

        //Ajoute la playlist en session
        $_SESSION['playlists'][] = $pl;

        return "Nouvelle playlist: {$nom}";
    }
}