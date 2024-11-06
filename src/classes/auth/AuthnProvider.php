<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthnException;
use iutnc\deefy\repository\DeefyRepository;

class AuthnProvider {

    public static function login(string $email, string $passwd2check){

        $r = DeefyRepository::getInstance();

        try {
            $userData = $r->getUserByEmail($email);
        } catch (\Exception $e) {
            throw new AuthnException("Erreur de connexion, mot de passe ou email incorrect");
        }

        $hash = $userData['passwd'];

        if (!password_verify($passwd2check, $hash)) {
            throw new AuthnException("Erreur de connexion, mot de passe ou email incorrect");
        } else {
            $_SESSION['id'] = $userData['id'];
            $_SESSION['email'] = $userData['email'];
            $_SESSION['hash'] = $userData['passwd'];
        }
    }

    public static function register(string $email, string $password, string $password_confirmation){

        $r = DeefyRepository::getInstance();

        try {
        	$r->getUserByEmail($email) ;
        } catch(\Exception $e){


	        if (! filter_var($email, FILTER_VALIDATE_EMAIL))
	            throw new AuthnException("Le mail est incorrect");

	        if (strlen($password) < 10)
	            throw new AuthnException("Le mot de passe est trop court");

	        if (! preg_match('/[A-Z]/', $password))
	            throw new AuthnException("Le mot de passe doit contenir une majuscule");

	        if ($password != $password_confirmation)
	        	throw new AuthnException("Les 2 mdp doivent correspondre") ;

	        $hash = password_hash($password, PASSWORD_DEFAULT, ['cost'=>12]);
	        $r->addUser($email, $hash, 1);

	        return ;
	    }

	    throw new AuthnException("Le mail est deja utilisé");
    }

    public static function logout(){
        session_destroy();
    }

    public static function asPermission(string $id, int $permission): bool {
        $r = DeefyRepository::getInstance();
        return $r->asPermission($id, $permission);
    }
}