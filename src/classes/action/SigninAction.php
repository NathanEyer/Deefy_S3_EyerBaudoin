<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository ;
use iutnc\deefy\auth\AuthnProvider ;

class SigninAction extends Action {

    public function execute(): string {

        $ret = "<h1>Page pour s'inscrire</h1>" ;

        if(isset($_POST['email']) and isset($_POST['password'])){
            try{
                AuthnProvider::signin($_POST['email'],$_POST['password']) ;
            } catch (\Exception $e){
                $ret .= 'non reconnu' ;
            }
            
        } else {
            $ret .= '<form action="index.php?action=signin" method="POST"><strong>S\'enregistrer</strong></br>
            <label for="email">E-mail: </label>
            <input type="text" id="email" name="email" required>
            <br>

            <label for="password">Mot de passe: </label>
            <input type="text" id="password" name="password" required>
            <br>

            <label for="password-confirmation">Confirmation du mot de passe: </label>
            <input type="text" id="password-confirmation" name="password-confirmation" required><br>
            <br>

            <button type="submit">Ajouter</button>
            </form>' ;
        }

    
        return $ret ;
    }
}

?>