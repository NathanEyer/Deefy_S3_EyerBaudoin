<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\PodcastRenderer;
use iutnc\deefy\repository\DeefyRepository;

class DisplayAllPodcastAction extends Action
{

    public function execute(): string
    {
        try{

            $r = DeefyRepository::getInstance() ;

            $a = $r->findAllPodcast() ;
            $ret = '<br><div style="text-align: left;">';

            foreach ($a as $track) {
                $renderer = new PodcastRenderer($track) ;
                $ret .= $renderer->render(1) ;
                $ret .= "<br>" ;
            }
            return $ret ;
        } catch(\Exception $e) {
            return "error" ;
        }
    }
}

?>