<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\auth\AuthnProvider;

class SigninAction extends Action {

    public function execute(): string {

        $ret = "";

        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirmation'])) {
            try {
                AuthnProvider::register($_POST['email'], $_POST['password'], $_POST['password-confirmation']);
                $ret .= '<p style="text-align: center;">Vous êtes inscrit !</p>';
            } catch (\Exception $e) {
                $ret .= '<p style="text-align: center;">' . $e->getMessage() . '</p>';
                $ret .= '<p style="text-align: center;"><a href="index.php?action=signin">réessayer</a></p>';
            }
        } else {
            $ret .= '<div style="text-align: center;">';
            $ret .= '<form action="index.php?action=signin" method="POST">
                        <br><strong style="font-size: 30px;">Inscription à Deefy</strong><br><br>
                        <label for="email" style="font-size: 25px;">E-mail: </label>
                        <input type="text" id="email" name="email" required><br>

                        <label for="password" style="font-size: 25px;">Mot de passe: </label>
                        <input type="password" id="password" name="password" required><br>

                        <label for="password-confirmation" style="font-size: 25px;">Confirmation du mot de passe: </label>
                        <input type="password" id="password-confirmation" name="password-confirmation" required><br><br>

                        <button type="submit" style="font-size: 25px">S\'inscrire !</button>
                    </form>';
            $ret .= '</div>';
        }

        return $ret;
    }
}

?>