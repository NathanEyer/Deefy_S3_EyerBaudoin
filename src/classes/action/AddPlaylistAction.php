<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\lists\Playlist;

session_start();

class AddPlaylistAction extends Action
{
    private $nom = "feur";
    public function execute(): string
    {
        $playlist = new Playlist($this->nom);

        $_SESSION['playlist'] = $playlist;

        return "Playlist {$this->nom} créé";
    }
}