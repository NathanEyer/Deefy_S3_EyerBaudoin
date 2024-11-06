<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository ;
use iutnc\deefy\auth\AuthnProvider ;

class LogOutAction extends Action {

    public function execute(): string {

        $ret = "" ;

        AuthnProvider::logout() ;

        $ret .= "<p>Vous etes deconnecté</p>" ;

        return $ret ;
    }
}

?>