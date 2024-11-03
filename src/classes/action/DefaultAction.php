<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository ;

class DefaultAction extends Action {

    public function execute(): string {

        $ret = "" ;

        try{
            $r = DeefyRepository::getInstance() ;
            $ret .= "Connexion reussie" ;
        } catch(\Exception $e) {
            $ret .= "ERR CONNEXION DB" ;
        }

        $ret .= '<h1>Bienvenue sur deefy</h1>
        <ul>
    <li><a href="index.php?action=show-playlist">Afficher la playlist courante</a></li>
    <li><a href="index.php?action=show-playlists">Afficher toutes les playlists</a></li>
    <li><a href="index.php?action=show-tracks">Afficher tte les tracks</a></li>
    <li>
        <form action="index.php?action=add-playlist" method="POST">
            <label for="nom">Nouvelle playlist:</label>
            <input type="text" id="nom" name="nom" required>
            <button type="submit">Créer</button>
        </form>
    </li>
    <li>
        <form action="index.php?action=add-podcasttrack" method="POST"><strong>Ajout d\'un PodCastTrack</strong></br>
            <label for="podcast-title">Titre: </label>
            <input type="text" id="podcast-title" name="podcast-title" required>

            <label for="podcast-fileName">Lien mp3: </label>
            <input type="text" id="podcast-fileName" name="podcast-fileName" required>

            <label for="podcast-artist">Artiste: </label>
            <input type="text" id="podcast-artist" name="podcast-artist" required><br>

            <label for="podcast-year">Année de sortie: </label>
            <input type="number" id="podcast-year" name="podcast-year" required>

            <label for="podcast-time">Durée en s: </label>
            <input type="number" id="podcast-time" name="podcast-time" required>

            <label for="podcast-sort">Genre: </label>
            <input type="text" id="podcast-sort" name="podcast-sort" required>
            <button type="submit">Ajouter</button>
        </form>
    </li>
    <li>
        <form action="index.php?action=add-albumtrack" method="POST"><strong>Ajout d\'un AlbumTrack</strong></br>
            <label for="album-title">Titre: </label>
            <input type="text" id="album-title" name="album-title" required>

            <label for="album-fileName">Lien mp3: </label>
            <input type="text" id="album-fileName" name="album-fileName" required>

            <label for="album-artist">Artiste: </label>
            <input type="text" id="album-artist" name="album-artist" required>

            <label for="album-year">Année de sortie: </label>
            <input type="number" id="album-year" name="album-year" required><br>

            <label for="album-time">Durée en s: </label>
            <input type="number" id="album-time" name="album-time" required>

            <label for="album-sort">Genre: </label>
            <input type="text" id="album-sort" name="album-sort" required>

            <label for="album-trackNumber" id="trackNumber">Numéro du track: </label>
            <input type="text" id="album-trackNumber" name="album-trackNumber" required>

            <label for="album" id="album">Nom de l\'album: </label>
            <input type="text" id="album" name="album" required>
            <button type="submit">Ajouter</button>
            </form>
            </li>
            </ul>';

            return $ret ;
    }
}