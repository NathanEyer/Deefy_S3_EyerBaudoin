<?php
declare(strict_types = 1);

namespace iutnc\deefy\render;
use iutnc\deefy\audio\tracks\PodcastTrack;

/**
 * Affiche les podcasts
 */
class PodcastRenderer extends AudioTrackRenderer {
    /**
     * @param PodcastTrack $track
     */
    function __construct(PodcastTrack $track) {
        parent::__construct($track);
    }

    /**
     * Affichage compact
     * @return string
     */
    protected function renderCompact() : string{
        $t = $this->track;
        return "\"$t->fileName\" type=\"audio/mpeg\" />"
            . "<p> Votre navigateur ne prend pas en charge l'audio HTML5. Voici un"
            . "<a href=\"$t->fileName\">lien vers le fichier audio</a> à la place."
            . "</p></audio>"
            . "Podcast: " . $t->title . "(" . $t->sort . ")"
            . " en " . $t->year . " par " . $t->artist
            . " d'une durée de "
            . $t->time . "s";
    }

    /**
     * Affichage long
     * @return string
     */
    protected function renderLong() : string{
        $t = $this->track;

        $minutes = floor($t->time / 60);
        $seconds = $t->time % 60;

        return "\"$t->fileName\" type=\"audio/mpeg\" />"
            . "<p> Votre navigateur ne prend pas en charge l'audio HTML5. Voici un"
            . "<a href=\"$t->fileName\">lien vers le fichier audio</a> à la place."
            . "</p></audio>"
            . "<ul>"
            . "<li>Titre: " . $t->title . "</li>"
            . "<li>Artiste: " . $t->artist . "</li>"
            . "<li>Genre: " . $t->sort . "</li>"
            . "<li>Année de sortie: " . $t->year . "</li>"
            . "<li>Durée: " . $minutes . "m et " . $seconds . "s" . "</li>"
            . "</ul>";
    }
}