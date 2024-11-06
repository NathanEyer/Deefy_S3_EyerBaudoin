<?php
declare(strict_types = 1);

namespace iutnc\deefy\action;
use iutnc\deefy\repository\DeefyRepository;

class DisplayAllPlaylistAction extends Action
{
    public function execute(): string
    {
        $r = DeefyRepository::getInstance() ;
        $playlists = $r->findAllPlaylist();

        //Affiche la liste des playlists avec un lien référant à l'affichage de celles-ci
        $html = "<ul>";
        foreach ($playlists as $playlist) {
            $nom = $playlist->name;
            $html .= "<li><a href=index.php?action=show-playlist&playlistID={$playlist->getID()}>" . $nom . "</a></li>";
        }
        return $html .= "</ul>";
    }
}