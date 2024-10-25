<?php

namespace iutnc\deefy\repository;

class DeefyRepository
{
    private static ?DeefyRepository $instance = null;
    private static array $connexion = [];

    public function setConfig($file){
        self::$connexion = parse_ini_file($file);
        if(!self::$connexion){
            throw new \Exception("Erreur de lecture");
        }
        
    }

    public function getInstance(): array{
        if(is_null(self::$instance)){
            self::$instance = new DeefyRepository(self::$connexion);
        }
        return self::$connexion;
    }
}