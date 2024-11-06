<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository ;
use iutnc\deefy\render\AlbumTrackRenderer ;

class DisplayAllTrackAction extends Action {

    public function execute(): string {
        try{

            $r = DeefyRepository::getInstance() ;

            $a = $r->findAllTrack() ;
            $ret = '<br><div style="text-align: left;">';

            foreach ($a as $track) {
                $renderer = new AlbumTrackRenderer($track) ;
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