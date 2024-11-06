<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\auth\AuthnProvider;

class LoginAction extends Action {

    public function execute(): string {

        $ret = '<div style="text-align: center;">';

        if (isset($_POST['email']) && isset($_POST['password'])) {
            try {
                AuthnProvider::login($_POST['email'], $_POST['password']);
                $ret .= '<p>Vous êtes connecté avec ' . htmlspecialchars($_SESSION['email']) . '</p>';
            } catch (\Exception $e) {
                $ret .= '<p style="color: red;">Les identifiants ne sont pas reconnus.</p>';
                $ret .= '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
            }
        } else {
            $ret .= '<form action="index.php?action=login" method="POST">
                        <br><strong style="font-size: 30px;">Se connecter</strong><br><br>
                        <label for="email" style="font-size: 25px;">E-mail: </label>
                        <input type="text" id="email" name="email" required><br>

                        <label for="password" style="font-size: 25px;">Mot de passe: </label>
                        <input type="password" id="password" name="password" required><br><br>

                        <button type="submit" style="font-size: 25px;">Se connecter !</button>
                    </form>';
        }

        $ret .= '</div>';
        return $ret;
    }
}
?>