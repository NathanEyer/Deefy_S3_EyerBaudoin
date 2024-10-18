
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deefy</title>
</head>
<body>
    <p>Deefy</p>

    <a href="index.php?action=playlist">playlist</a>
</body>
</html>


<?php

require_once 'src/vendor/autoload.php';

//Use pour se faciliter la tâche
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\lists\Album;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\exception\InvalidPropertyValueException;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\PodcastRenderer;
use iutnc\deefy\render\Renderer;

try {
    // Création de pistes d'album
    $piste1 = new AlbumTrack("Blinding Lights", "resources/Blinding_Lights.mp3");
    $piste1->setAlbum("After Hours");
    $piste1->setArtist("The Weeknd");
    $piste1->setSort("Pop");
    $piste1->setTrackNumber(1);
    $piste1->setYear(2020);
    $piste1->setTime(194);

    $piste2 = new AlbumTrack("Save Your Tears", "resources/Save_Your_Tears.mp3");
    $piste2->setAlbum("After Hours");
    $piste2->setArtist("The Weeknd");
    $piste2->setSort("Pop");
    $piste2->setTrackNumber(2);
    $piste2->setYear(2020);
    $piste2->setTime(245);

    // Création de pistes de podcast
    $piste3 = new PodcastTrack("Le regard des autres", "resources/RegardDesAutres.mp3");
    $piste3->setArtist("Le Précepteur");
    $piste3->setSort("Podcast");
    $piste3->setYear(2021);
    $piste3->setTime(2468);

    $piste4 = new PodcastTrack("Stuff You Should Know", "resources/StuffYouShouldKnow.mp3");
    $piste4->setArtist("Josh & Chuck");
    $piste4->setSort("Podcast");
    $piste4->setYear(2021);
    $piste4->setTime(2823);

    // Création de l'album
    $album = new Album("After Hours", [$piste1, $piste2], "The Weeknd", 2020);

    // Création de la playlist
    $playlist = new Playlist("Best of Podcasts");
    $playlist->addTrack($piste3); // Ajout de la piste 3 (podcast) à la playlist
    $playlist->addTrack($piste4); // Ajout de la piste 4 (podcast) à la playlist

} catch (InvalidPropertyValueException $e) {
    print "Erreur : " . $e->getMessage() . "\nTrace : " . $e->getTraceAsString();
}

// Affichage des pistes de l'album
echo "<h2>Album: " . $album->name . " (" . $album->releaseDate . ")</h2><br>";
foreach ($album as $track) {
    $r = new AlbumTrackRenderer($track);
    echo $r->render(Renderer::LONG) . "<br>";
}

// Affichage des pistes de la playlist (podcasts)
echo "<h2>Playlist: " . $playlist->name . "</h2><br>";
foreach ($playlist as $track) {
    if ($track instanceof PodcastTrack) {
        $r = new PodcastRenderer($track);
        echo $r->render(Renderer::LONG) . "<br>";
    }
}
?>
