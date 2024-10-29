<?php

namespace iutnc\deefy\action;
class DisplayPlaylistsAction extends Action
{
    public function execute(): string
    {
        //Vérifie qu'il y a des playlists enregistrées
        if (empty($_SESSION['playlists'])) {
            return "Aucune playlist trouvée";
        }

        //Affiche la liste des playlists avec un lien référant à l'affichage de celles-ci
        $html = "<ul>";
        foreach ($_SESSION['playlists'] as $playlist) {
            $nom = $playlist->name;
            $html .= "<li><a href=\"index.php?action=show-playlist&nom=$nom\">" . $nom . "</a></li>";
        }
        return $html .= "</ul>";
    }
}