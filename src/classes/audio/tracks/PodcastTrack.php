<?php
declare(strict_types = 1);

namespace iutnc\deefy\audio\tracks;
/**
 * Crée une piste de podcast
 */
class PodcastTrack extends AudioTrack{
    /**
     * @param int $id
     * @param string $title
     * @param string $artist
     * @param string $sort
     * @param int $time
     * @param string $fileName
     * @param string $year
     */
    public function __construct(int $id, string $title, string $artist, string $sort, int $time, string $fileName, string $year) {
        parent::__construct($id, $title, $artist, $sort, $time, $fileName, $year);
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