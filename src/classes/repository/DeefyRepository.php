<?php

namespace iutnc\deefy\repository;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AlbumTrack ;
use iutnc\deefy\audio\tracks\AudioTrack;

class DeefyRepository
{
    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $connexion = [];

    private function __construct(array $conf){

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
    //Vérification appel hote provider if(loggé) else erreur
    public function findAllPlaylist(): array {
        try {
            Auth::checkRole(User::ADMIN_USER);

            $query = "Select id, nom from playlist";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            $a = [] ;
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC); ;
            foreach ($result as $r) {
                $playlist = new Playlist($r['nom']);
                $playlist->setId($r['id']);
                $a[] = $playlist;
            }

            return $a ;
        } catch(UserException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function findPlaylistById(int $id): ?Playlist {
        try {
            Auth::checkRole(User::ADMIN_USER);

            try {
                $query = 'Select id, nom from playlist where id = :id';
                $stmt = $this->pdo->prepare($query);
                $stmt->execute(['id' => $id]);

                $result = $stmt->fetch(\PDO::FETCH_ASSOC);
                if ($result) {
                    return new Playlist($result['nom']);
                }
                return null;
            }catch (\PDOException $e){
                throw new \Exception($e->getMessage());
            }
        } catch(UserException $e) {
            throw new \Exception($e->getMessage());
        }

    }


    public function saveEmptyPlaylist(Playlist $pl): Playlist {
        try {
            Auth::checkRole(User::ADMIN_USER);

            $query = "Insert into playlist (nom) values (:nom)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['nom' => $pl->nom]);

            $pl->setID($this->pdo->lastInsertId());
            return $pl;
        } catch(UserException $e) {
            throw new \Exception($e->getMessage());
        }


    }

    public function saveTrack(AudioTrack $aT) {
        try {
            Auth::checkRole(User::ADMIN_USER);
            $query = 'INSERT INTO track (titre, genre, duree, fileName, artiste_album, annee_album) 
              VALUES (:title, :sort, :time, :fileName, :artist, :year)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'title' => $aT->title,
                'sort' => $aT->sort,
                'time' => $aT->time,
                'fileName' => $aT->fileName,
                'artist' => $aT->artist,
                'year' => $aT->year
            ]);

        } catch(AccessControlException $e) {
            throw new \Exception($e->getMessage());
        }


    }

    public function addTrackPlaylist(Playlist $pl, AudioTrack $ad): void {
        try {
            Auth::checkRole(User::ADMIN_USER);
            Auth::checkPlaylistOwner($pl->getID());

            $query = "Insert into playlist2track (playlist_id, track_id) values (:playlist_id :track_id)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'playlist_id' => $pl->id,
                'track_id' => $ad->id
            ]);
        } catch(AccessControlException $e) {
            throw new \Exception($e->getMessage());
        }


    }

    // Renvoie un array de AudioTrack
    public function findAllTrack(): array {
        try {
            Auth::checkRole(User::ADMIN_USER);

            $query = "select titre, artiste_album, genre, duree, filename, annee_album, titre_album, numero_album from track" ;
            $stmt = $this->pdo->prepare($query) ;
            $stmt->execute() ;

            $a = [] ;
            $result = $stmt->fetch() ;
            while($result!=null){
                if($result['artiste_album']!=null){
                    $a[] = new AlbumTrack($result['titre'],$result['artiste_album'],$result['genre'],$result['duree'],$result['filename'],$result['annee_album'],$result['titre_album'], $result['numero_album']) ; }
                $result = $stmt->fetch() ;
            }

            return $a ;
        } catch(AccessControlException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}