<?php

namespace iutnc\deefy\repository;

use iutnc\deefy\audio\lists\Playlist;

class DeefyRepository
{
    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $connexion = [];

    private function __construct(array $conf) {

        $address = 'mysql:host='.$conf['host'].':'.$conf['port'].';dbname='.$conf['dbname'].';charset=utf8' ;

        $this->pdo = new \PDO($address, $conf['username'], $conf['password']);
        // [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION] a voir l'utilite du param la
    }

    public static function setConfig(string $file) {
        $conf = parse_ini_file($file);
        if ($conf === false) {
            throw new \Exception("Error reading configuration file");
        }
        self::$connexion = [
            'host'=> $conf['host'],
            'port'=> $conf['port'],
            'dbname'=> $conf['dbname'],
            'username'=> $conf['username'],
            'password'=> $conf['password'] 
        ];
    }

    public static function getInstance(): DeefyRepository{
        if(is_null(self::$instance)){
            self::$instance = new DeefyRepository(self::$connexion);
        }
        return self::$instance;
    }

    //TOUTES LES METHODES A COMPLETER
    public function findAllPlaylist(int $id): array {
        return [new Playlist($id, [])];
    }

    public function findPlaylistById(int $id): Playlist {
        return new Playlist($id, []);
    }

    public function saveEmptyPlaylist(Playlist $pl): Playlist {
        $query = "Insert into playlist (nom) values (:nom)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $pl->nom]);
        //SETID A CREER
        $pl->setID($this->pdo->lastInsertId());
        return $pl;
    }

    public function saveTrack(Playlist $pl): Playlist {
        return new Playlist($pl, []);
    }

    public function addTrackPlaylist(Playlist $pl): Playlist {
        return new Playlist($pl, []);
    }
}