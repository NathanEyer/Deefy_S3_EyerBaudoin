<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository ;
use iutnc\deefy\auth\AuthnProvider ;

class LoginAction extends Action {

    public function execute(): string {

        $ret = "<h1>Page pour se connecter</h1>" ;

        if(isset($_POST['email']) and isset($_POST['password'])){
            try{
                AuthnProvider::signin($_POST['email'],$_POST['password']) ;
            } catch (\Exception $e){
                // l'utilisateur n'est pas reconnu
            }
            
        } else {
            $ret .= '<form action="index.php?action=signin" method="POST"><strong>S\'enregistrer</strong></br>
            <label for="email">E-mail: </label>
            <input type="text" id="email" name="email" required>
            <br>

            <label for="password">Mot de passe: </label>
            <input type="text" id="password" name="password" required>
            <br>

            <button type="submit">se connecter</button>
            </form>' ;
        }

        return $ret ;
    }
}

?>