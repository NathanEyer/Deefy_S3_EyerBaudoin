<?php
namespace iutnc\deefy\audio\lists;
use Iterator;
use iutnc\deefy\exception\InvalidPropertyNameException;

/**
 * Gère des listes de pistes audio
 */
class AudioList implements Iterator{
    //Attributs de description de la liste
    private int $position = 0;

    protected string $name;
    protected int $sumTracks, $globalTime;
    protected array $tracksList;

    /**
     * @param string $name
     * @param array $tracksList
     */
    public function __construct(string $name, array $tracksList = []){
        $this->name = $name;
        $this->tracksList = $tracksList;
        $this->refresh();
    }

    /**
     * Actualise le nombre de pistes et le temps
     * @return void
     */
    public function refresh(): void{
        $this->sumTracks = count($this->tracksList);
        $d = 0;
        for($i = 0; $i < $this->sumTracks; $i++){
            $d += $this->tracksList[$i]->time;
        }
        $this->globalTime = $d;
    }

    /**
     * Get magique
     * @param string $name
     * @return mixed
     * @throws InvalidPropertyNameException
     */
    public function __get(string $name): mixed{
        if(property_exists($this, $name)) return $this->$name;
        throw new InvalidPropertyNameException("invalid property : $name");
    }

    public function current(){
        return $this->tracksList[$this->position];
    }

    public function next(){
        return $this->tracksList[$this->position++];
    }

    public function key(){
        return $this->tracksList[$this->position];
    }

    public function valid(): bool{
        return isset($this->tracksList[$this->position]);
    }

    public function rewind(): void{
        $this->position = 0;
    }
}