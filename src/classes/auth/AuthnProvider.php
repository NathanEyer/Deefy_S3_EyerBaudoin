<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthnException;
use iutnc\deefy\repository\DeefyRepository;

class AuthnProvider {

    public static function signin(string $email, string $passwd2check){

        $r = DeefyRepository::getInstance();

        try {
            $userData = $r->getUserByEmail($email);

            if (empty($userInfo)) {
                return "Erreur de connexion, mot de passe ou email incorrect";
            }

        } catch (\Exception $e) {
            return "Erreur de connexion, mot de passe ou email incorrect";
        }

        $hash = $userData['passwd'];

        if (!password_verify($passwd2check, $hash)) {
            return "Erreur de connexion, mot de passe ou email incorrect";
        } else {
            $_SESSION['user'] = $userData['id'];
            return "Connexion réussie";
        }
    }

    public static function register(string $email, string $password){

        $r = DeefyRepository::getInstance();

        /* ACCOUNT VALIDATION */
        try {
            if($r->getUserByEmail($email) != null)
                throw new AuthnException(" error : user already exists");
        } catch (\Exception $e) {
            throw new AuthnException(" error : user already exists");
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new AuthnException(" error : invalid user email");

        if (strlen($password) < 10)
            throw new AuthnException(" error : password too short");

        if (! preg_match('/[A-Z]/', $password))
            throw new AuthnException(" error : password must contain at least one uppercase letter");

        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost'=>12]);
        $r->addUser($email, $hash, 1);
    }

    public static function signout(){
        session_destroy();
    }

    public static function asPermission(string $id, int $permission): bool {
        $r = DeefyRepository::getInstance();
        return $r->asPermission($id, $permission);
    }
}