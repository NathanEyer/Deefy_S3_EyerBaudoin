<?php
declare(strict_types = 1);

namespace iutnc\deefy\repository;

use iutnc\deefy\audio\lists\Playlist;

class DeefyRepository
{
    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $connexion = [];

    private function __construct(array $conf) {
        $this->pdo = new \PDO($conf['dsn'], $conf['user'], $conf['pass'],
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public static function setConfig(string $file) {
        $conf = parse_ini_file($file);
        if ($conf === false) {
            throw new \Exception("Error reading configuration file");
        }
        self::$connexion = [ 'dsn'=> "...",'user'=> $conf['username'],'pass'=> '...' ];
    }

    public function getInstance(): array{
        if(is_null(self::$instance)){
            self::$instance = new DeefyRepository(self::$connexion);
        }
        return self::$connexion;
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