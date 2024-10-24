
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
    $piste1 = new AlbumTrack("Blinding Lights", "The Weeknd", "Pop", 194, "resources/Blinding_Lights.mp3", 2020, "After Hours", 1);

    $piste2 = new AlbumTrack("Save Your Tears", "The Weeknd", "Pop", 245, "resources/Save_Your_Tears.mp3", 2020, "After Hours", 2);

    // Création de pistes de podcast
    $piste3 = new PodcastTrack("Le regard des autres", "Le Précepteur", "PodCast", 2468, "resources/RegardDesAutres.mp3", 2021);

    $piste4 = new PodcastTrack("Stuff You Should Know", "Josh & Chuck", "PodCast", 2823, "resources/StuffYouShouldKnow.mp3", 2021);

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
