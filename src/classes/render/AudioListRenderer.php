<?php
declare(strict_types = 1);

namespace iutnc\deefy\render;
use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

/**
 * Affiche les listes de pistes en HTML
 */
abstract class AudioListRenderer implements Renderer{
    //Attribut à afficher
    private AudioList $audioList;

    /**
     * @param AudioList $audioList
     */
    public function __construct(AudioList $audioList){
        $this->audioList = $audioList;
    }

    /**
     * @param int $selector
     * @return string
     */
    public function render(int $selector): string {
        $t = $this->audioList;
        $res = $t->name . ": ";

        foreach ($t->tracksList as $track) {
            // Vérification du type de la piste
            if ($track instanceof AlbumTrack) {
                $renderer = new AlbumTrackRenderer($track);
            } elseif ($track instanceof PodcastTrack) {
                $renderer = new PodcastRenderer($track);
            }

            $res .= $renderer->render($selector) . "<br>";
        }

        return $res . ", " . $t->sumTracks . ", " . $t->globalTime;
    }
}