<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\exception\InvalidPropertyValueException;

class AddPodcastTrackAction extends Action
{
    public function execute(): string
    {
        session_start();

        if (isset($_SESSION['playlist'])) {
            $piste1 = new PodcastTrack("Le regard des autres", "resources/RegardDesAutres.mp3");
            $piste1->setArtist("Le Précepteur");
            $piste1->setSort("Podcast");
            $piste1->setYear(2021);
            try {
                $piste1->setTime(194);
            } catch (InvalidPropertyValueException $e) {
                print $e->getMessage();
            }
            $_SESSION['playlist']->addTrack($piste1);
            return "PodcastTrack ajouté";
        } else {
            return "<p>Playlist inexistante</p>";
        }
    }
}