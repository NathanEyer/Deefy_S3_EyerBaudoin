<?php
namespace iutnc\deefy\audio\tracks;
/**
 * Crée une piste de podcast
 */
class PodcastTrack extends AudioTrack{
    /**
     * @param string $title
     * @param string $file
     */
    function __construct(string $title, string $file){
        parent::__construct($title,$file);
    }

    /**
     * Affiche correctement la piste
     * @return string
     */
    function __toString() : string{
        return json_encode([
            'title' => $this->title,
            'artist' => $this->artist,
            'sort' => $this->sort,
            'time' => $this->time,
            'fileName' => $this->fileName,
            'year' => $this->year
        ]);
    }
}