<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\Playlist;

class AddPlaylistAction extends Action
{
    public function execute(): string
    {
        //Vérifie que le nom est acceptable
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);

        //Crée la playlist
        $playlist = new Playlist($nom);

        //Crée le tableau en sessions
        if(!isset($_SESSION['playlists'])) {
            $_SESSION['playlists'] = [];
        }

        //Ajoute la playlist en session
        $_SESSION['playlists'][] = $playlist;

        return "Nouvelle playlist: {$nom}";
    }
}