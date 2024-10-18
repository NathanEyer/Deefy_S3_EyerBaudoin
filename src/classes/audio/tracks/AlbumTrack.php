<?php
namespace iutnc\deefy\audio\tracks;
/**
 * Représente les pistes audio d'un album
 */
class AlbumTrack extends AudioTrack {
    //attributs du nom et du numéro de l'album
    protected string $album;
    protected int $trackNumber;

    /**
     * @param $file string
     * @param $title string
     */
    public function __construct(string $title, string $file){
        parent::__construct($title, $file);
    }

    /**
     * Stocke l'objet au format json
     * @return string de l'objet sous forme de chaîne de caractère
     */
    public function __toString() : string{
        return json_encode([
            'title' => $this->title,
            'artist' => $this->artist,
            'sort' => $this->sort,
            'time' => $this->time,
            'fileName' => $this->fileName,
            'year' => $this->year,
            'album' => $this->album,
            'trackNumber' => $this->trackNumber
        ]);
    }

    /**
     * Permet de modifier l'attribut album
     * @param string $album
     * @return void
     */
    public function setAlbum(string $album): void{$this->album = $album;}

    /**
     * Permet de modifier l'attribut trackNumber
     * @param int $trackNumber
     * @return void
     */
    public function setTrackNumber(int $trackNumber): void{$this->trackNumber = $trackNumber;}
}