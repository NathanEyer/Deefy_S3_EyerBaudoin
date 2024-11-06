<?php

namespace iutnc\deefy\repository;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AlbumTrack ;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class DeefyRepository
{
    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $connexion = [];

    private function __construct(array $conf){

        $address = 'mysql:host='.$conf['host'].':'.$conf['port']    .';dbname='.$conf['dbname'].';charset=utf8' ;

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

    public function findAllPlaylist(): array {

        $query = "Select id, nom from playlist";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $a = [] ;
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC); ;
        foreach ($result as $r) {
            $playlist = new Playlist($r['id'], $r['nom']);
            $playlist->setId($r['id']);
            $a[] = $playlist;
        }

        return $a ;
    }

    public function findPlaylistById(int $id): ?Playlist {

        $query = 'Select id, nom from playlist where id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return new Playlist($result['id'], $result['nom']);
        }
        return null;

    }

    public function delPlaylistByName(string $nom): void{
        $query = 'Delete from playlist where nom = :nom';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $nom]);
    }

    public function saveEmptyPlaylist(Playlist $pl): Playlist|null {
        foreach($this->findAllPlaylist() as $playlist){
            if($playlist->name == $pl->name){return null;}
        };
        $query = "Insert into playlist (nom) values (:nom)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['nom' => $pl->name]);

        $pl->setID($this->pdo->lastInsertId()+1);
        return $pl;
    }

    public function saveTrack(AudioTrack $aT) {
        if($aT instanceof PodcastTrack){
            $query = 'INSERT INTO track (id, titre, genre, duree, fileName, auteur_podcast, date_podcast, type) 
          VALUES (:id, :title, :sort, :time, :fileName, :artist, :year, :type)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'id' => $aT->id,
                'title' => $aT->title,
                'sort' => $aT->sort,
                'time' => $aT->time,
                'fileName' => $aT->fileName,
                'artist' => $aT->artist,
                'year' => $aT->year,
                'type' => 'P'
            ]);
        }else{
            $query = 'INSERT INTO track (id, titre, artiste_album, genre, duree, fileName, annee_album, numero_album) 
          VALUES (:id, :title, :artist, :sort, :time, :fileName, :year, :album, :trackNumber)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'id' => $aT->id,
                'title' => $aT->title,
                'artist' => $aT->artist,
                'sort' => $aT->sort,
                'time' => $aT->time,
                'fileName' => $aT->fileName,
                'year' => $aT->year,
                'album' => $aT->album,
                'trackNumber' => $aT->trackNumber,
                'type' => 'A'
            ]);
        }
    }

    public function addTrackPlaylist(Playlist $pl, AudioTrack $ad): void {
        $query = "Insert into playlist2track (playlist_id, track_id) values (:playlist_id :track_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'playlist_id' => $pl->id,
            'track_id' => $ad->id
        ]);
    }

    // Renvoie un array de AudioTrack
    public function findAllTrack(): array {

        $query = "select id, titre, artiste_album, genre, duree, filename, annee_album, titre_album, numero_album from track" ;
        $stmt = $this->pdo->prepare($query) ;
        $stmt->execute() ;

        $a = [] ;
        $result = $stmt->fetch() ;
        while($result!=null){
            if($result['artiste_album']!=null){
                $a[] = new AlbumTrack($result['id'], $result['titre'],$result['artiste_album'],$result['genre'],$result['duree'],$result['filename'],$result['annee_album'],$result['titre_album'], $result['numero_album']) ; }
            $result = $stmt->fetch() ;
        }

        return $a ;
    }

    public function getUserByEmail(string $email): array {
        $query = "SELECT * FROM User WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        $userData = $stmt->fetch();

        if (empty($userData)) {
            throw new \Exception("User not found");
        }
        return $userData;
    }

    public function getUserByID(string $id): array {
        $query = "SELECT * FROM deefy_user WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);

        $userData = $stmt->fetch();

        if (empty($userData)) {
            throw new \Exception("User not found");
        }
        return $userData;
    }


    public function addUser(string $email, string $hash, int $role) {
        $query = "INSERT INTO User (email, passwd, role) VALUES (:email, :passwd, :role)";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute(['email' => $email, 'passwd' => $hash, 'role' => $role]);
    }

    public function asPermission(string $id, string $perm): bool {
        $query = "SELECT * FROM User WHERE id = :id AND role = :role";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id, 'role' => $perm]);

        $row = $stmt->fetch();
        return $row >= $perm;
    }

    public function isPlaylistOwner(string $id, string $pl_id): bool {
        $query = "SELECT * FROM user2playlist WHERE id_user = :id_user AND id_pl = :id_pl";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id_user' => $id, 'id_pl' => $pl_id]);

        $row = $stmt->fetch();
        return $row !== false;
    }
}