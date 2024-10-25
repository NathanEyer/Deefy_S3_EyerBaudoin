<?php

namespace iutnc\deefy\action;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\Renderer;

session_start();

class DisplayPlaylistAction extends Action
{
    public function execute(): string
    {

        if (!isset($_SESSION['playlist'])) {
            return "Playlist introuvable";
        }

        $playlist = $_SESSION['playlist'];
        if ($playlist->__get('sumTracks')==0){
            return "La playlist est vide";
        }

        $html = '';
        foreach ($playlist as $track) {
            $r = new AlbumTrackRenderer($track);
            $html .= $r->render(Renderer::COMPACT);
        }

        return $html;
    }
}
