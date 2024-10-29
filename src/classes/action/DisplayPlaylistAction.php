<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\PodcastRenderer;
use iutnc\deefy\render\Renderer;

class DisplayPlaylistAction extends Action
{
    public function execute(): string
    {
        //Vérifie que des playlists sont enregistrées
        if (empty($_SESSION['playlists'])) {
            return "Playlists introuvables";
        }

        $playlist = end($_SESSION['playlists']);

        //Vérifie que celle-ci n'est pas vide
        if (empty($playlist)) return "Playlist vide";

        //Affiche le render des sons
        $html = "<strong>{$playlist->name}</strong></br>";
        foreach ($playlist->tracksList as $track) {
            if($track instanceof PodcastTrack){
                $r = new PodcastRenderer($track);
            }else{
                $r = new AlbumTrackRenderer($track);
            }
            $html .= $r->render(Renderer::COMPACT);
            $html .= "</br>";
        }
        return $html;
    }
}
