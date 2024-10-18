<?php
namespace iutnc\deefy\audio\tracks;
/**
 * Crée une piste de podcast
 */
class PodcastTrack extends AudioTrack{
    /**
     * @param string $title
     * @param string $artist
     * @param string $sort
     * @param int $time
     * @param string $fileName
     * @param int $year
     */
    public function __construct(string $title, string $artist, string $sort, int $time, string $fileName, int $year) {
        parent::__construct($title, $artist, $sort, $time, $fileName, $year);
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