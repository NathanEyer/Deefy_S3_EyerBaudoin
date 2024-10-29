<?php
declare(strict_types = 1);

namespace iutnc\deefy\audio\lists;
/**
 * Sous-classe d'AudioList qui représente un album
 */
class Album extends AudioList{
    //Attributs du nom de l'artiste, et la date de sortie
    protected string $artist;
    protected string $releaseDate;

    /**
     * @param string $name
     * @param array $tracksList
     * @param string $artist
     * @param string $releaseDate
     */
    public function __construct(string $name, array $tracksList, string $artist, string $releaseDate){
        parent::__construct($name, $tracksList);
        $this->artist = $artist;
        $this->releaseDate = $releaseDate;
    }

    /**
     * Permet de modifier l'attribut artist
     * @param string $artist
     * @return void
     */
    public function setArtist(string $artist): void{
        $this->artist = $artist;
    }

    /**
     * Permet de mofier l'attribut releaseDate
     * @param string $releaseDate
     * @return void
     */
    public function setReleaseDate(string $releaseDate): void{
        $this->releaseDate = $releaseDate;
    }
}