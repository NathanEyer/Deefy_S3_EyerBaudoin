<?php
namespace iutnc\deefy\audio\tracks;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

/**
 * Piste Audio
 */
abstract class AudioTrack{
    //Attributs de description de la piste
    private string $title, $artist, $sort, $time, $fileName;
    private int $year;

    /**
     * @param string $title
     * @param string $fileName
     */
    public function __construct(string $title, string $fileName){
        $this->title = $title;
        $this->fileName = $fileName;
    }

    /**
     * Affiche correctement la piste
     * @return string
     */
    public function __toString() : string{
        return json_encode($this);
    }

    /**
     * get magique
     * @throws InvalidPropertyNameException
     */
    public function __get(string $name): mixed{
        if(property_exists($this, $name)) return $this->$name;
        throw new InvalidPropertyNameException("invalid property : $name");
    }

    /**
     * Permet de modifier l'attribut artist
     * @param string $artist
     * @return void
     */
    public function setArtist(string $artist): void{$this->artist = $artist;}

    /**
     * Permet de modifier l'attribut sort
     * @param string $sort
     * @return void
     */
    public function setSort(string $sort): void{$this->sort = $sort;}

    /**
     * Permet de modifier l'attribut time
     * @throws InvalidPropertyValueException
     */
    public function setTime(string $time): void{
        if($time > 0){$this->time = $time;}
        else{throw new InvalidPropertyValueException("invalid property : $time");}
    }

    /**
     * Permet de modifier l'attribut year
     * @param int $year
     * @return void
     */
    public function setYear(int $year): void{$this->year = $year;}
}