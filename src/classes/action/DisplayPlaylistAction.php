<?php
declare(strict_types = 1);

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
        if (empty($_SESSION['playlist'])) {
            return "Playlist introuvables";
        }

        $playlist = unserialize($_SESSION['playlist']);

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
