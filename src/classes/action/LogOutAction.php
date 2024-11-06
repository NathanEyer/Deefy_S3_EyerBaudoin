<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository ;
use iutnc\deefy\auth\AuthnProvider ;

class LogOutAction extends Action {

    public function execute(): string {

        $ret = '<div style="text-align: center;">';

        AuthnProvider::logout() ;

        $ret .= "<p><strong style='font-size: 24px'> Vous êtes déconnecté.</p>" ;

        return $ret ;
    }
}

?>