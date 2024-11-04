<?php
declare(strict_types = 1);

namespace iutnc\deefy\audio\lists;
use iutnc\deefy\audio\tracks\AudioTrack;

/**
 * Crée une playlist
 */
class Playlist extends AudioList{
    private int $id;

    /**
     * @param int $id
     * @param string $name
     * @param array $tracksList
     */
    public function __construct(int $id, string $name, array $tracksList = []){
        parent::__construct($name, $tracksList);
        $this->id = $id;
    }

    /**
     * Ajoute une piste à la playlist
     * @param AudioTrack $track
     * @return void
     */
    public function addTrack(AudioTrack $track): void{
        try{
            foreach ($this->tracksList as $e){
                if($e === $track){
                    return ;
                }
            }
            $this->tracksList[] = $track;
        }catch (\TypeError $e){
            echo $e->getMessage();
        }
        $this->refresh();
    }

    /**
     * Retire une piste de la playlist
     * @param int $index
     * @return void
     */
    public function removeTrack(int $index):void{
        $this->tracksList[$index] = null;
        $this->refresh();
    }

    /**
     * Ajoute une liste de pistes
     * @param array $tracks
     * @return void
     */
    public function addListTracks(array $tracks):void{
        foreach($tracks as $track){
            $this->addTrack($track);
        }
        $this->refresh();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($number):void{
        $this->id = $number;
        $this->refresh();
    }
}