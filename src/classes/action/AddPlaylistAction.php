<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\lists\Playlist;

session_start();

class AddPlaylistAction extends Action
{
    public function execute(): string
    {
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);

        $playlist = new Playlist($nom);
        $_SESSION[$nom] = $playlist;

        return "Nouvelle playlist: {$nom}";
    }
}