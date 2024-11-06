<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository;

class DefaultAction extends Action {

    public function execute(): string {
        $ret = "";

        // Message de connexion
        if (isset($_SESSION['email'])) {
            $ret .= '<p style="text-align: center;">Vous êtes connecté avec ' . $_SESSION['email'] . '</p>';
        }

        // Contenu principal
        $ret .= '<h1 style="text-align: center;">Bienvenue sur deefy</h1>
        <div style="max-width:900px; margin: auto; display: flex;">
            <div style="flex: 1; margin-right: 20px;">
                <ul style="list-style-type: none; padding: 0;">
                    <li style="margin-bottom: 20px;">
                        <form action="index.php?action=add-playlist" method="POST">
                            <label for="nom"><strong>Nouvelle playlist:</strong></label>
                            <input type="text" id="nom" name="nom" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <button type="submit" style="padding: 8px 16px; margin-top: 10px;">Créer</button>
                        </form>
                    </li>
                    <li style="margin-bottom: 20px;">
                        <form action="index.php?action=delete-playlist" method="POST">
                            <label for="nom_playlist_sup"><strong>Supprimer playlist:</strong></label>
                            <input type="text" id="nom_playlist_sup" name="nom_playlist_sup" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <button type="submit" style="padding: 8px 16px; margin-top: 10px;">Supprimer</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div style="flex: 1; margin-right: 20px;">
                <ul style="list-style-type: none; padding: 0;">
                    <li style="margin-bottom: 20px;">
                        <form action="index.php?action=add-podcasttrack" method="POST"><strong>Ajout d\'un PodCastTrack</strong></br>
                            <label for="podcast-title">Titre: </label>
                            <input type="text" id="podcast-title" name="podcast-title" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="podcast-fileName">Lien mp3 : </label>
                            <input type="text" id="podcast-fileName" name="podcast-fileName" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="podcast-artist">Artiste: </label>
                            <input type="text" id="podcast-artist" name="podcast-artist" required style="width: 100%; padding: 8px; margin-top: 5px;"><br>
                            <label for="podcast-year">Année de sortie: </label>
                            <input type="text" id="podcast-year" name="podcast-year" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="podcast-time">Durée en s: </label>
                            <input type="number" id="podcast-time" name="podcast-time" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="podcast-sort">Genre: </label>
                            <input type="text" id="podcast-sort" name="podcast-sort" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="podcast-playlist">Playlist: </label>
                            <input type="text" id="podcast-playlist" name="podcast-playlist" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <button type="submit" style="padding: 8px 16px; margin-top: 10px;">Ajouter</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div style="flex: 1;">
                <ul style="list-style-type: none; padding: 0;">
                    <li style="margin-bottom: 20px;">
                        <form action="index.php?action=add-albumtrack" method="POST"><strong>Ajout d\'un AlbumTrack</strong></br>
                            <label for="album-title">Titre: </label>
                            <input type="text" id="album-title" name="album-title" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="album-fileName">Nom de la musique: </label>
                            <input type="text" id="album-fileName" name="album-fileName" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="album-artist">Artiste: </label>
                            <input type="text" id="album-artist" name="album-artist" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="album-year">Année de sortie: </label>
                            <input type="text" id="album-year" name="album-year" required style="width: 100%; padding: 8px; margin-top: 5px;"><br>
                            <label for="album-time">Durée en s: </label>
                            <input type="number" id="album-time" name="album-time" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="album-sort">Genre: </label>
                            <input type="text" id="album-sort" name="album-sort" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="album-trackNumber" id="trackNumber">Numéro du track: </label>
                            <input type="text" id="album-trackNumber" name="album-trackNumber" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="album" id="album">Nom de l\'album: </label>
                            <input type="text" id="album" name="album" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <label for="album-playlist">Playlist: </label>
                            <input type="text" id="album-playlist" name="album-playlist" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <button type="submit" style="padding: 8px 16px; margin-top: 10px;">Ajouter</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>';

        return $ret;
    }
}