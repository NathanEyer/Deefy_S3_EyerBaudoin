<?php
declare(strict_types = 1);

namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\PodcastRenderer;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\repository\DeefyRepository;

/**
 * Display une playlist dont l'ID est transmis dans le GET
 */
class DisplayPlaylistAction extends Action
{
    public function execute(): string
    {

        //Vérifie que des playlists sont enregistrées
        if (empty($_SESSION['playlist'])) {
            return "<br><div style='text-align: center; font-size: 25px'> Playlist introuvable</div>";
        }


        if(isset($_GET['playlistID'])){

            $r = DeefyRepository::getInstance() ;
            $pl = $r->findPlaylistById((int)$_GET['playlistID']) ;
            $a = $r->findAllTrackByPlaylistID((int)$_GET['playlistID']) ;

            $html = "<strong>{$pl->__get('name')}</strong></br>";
            $html .= "<a href=index.php?action=show-playlist&setCurrPlaylist={$pl->getID()}>Ecouter cette playlist</a>" ;
            $html .= "<br>" ;
            foreach ($a as $track) {
                if($track instanceof PodcastTrack){
                    $r = new PodcastRenderer($track);
                }else{
                    $r = new AlbumTrackRenderer($track);
                }
                $html .= $r->render(Renderer::COMPACT);
                $html .= "</br>";
            }
            return $html;

        }

        if(isset($_GET['setCurrPlaylist'])) {

            $_SESSION['currPlaylistID'] = $_GET['setCurrPlaylist'] ;

        }


        if(isset($_SESSION['currPlaylistID'])) {

            $r = DeefyRepository::getInstance() ;
            $pl = $r->findPlaylistById((int)$_SESSION['currPlaylistID']) ;
            $a = $r->findAllTrackByPlaylistID((int)$_SESSION['currPlaylistID']) ;

            $html = "<strong>{$pl->__get('name')}</strong></br>";
            foreach ($a as $track) {
                if($track instanceof PodcastTrack){
                    $r = new PodcastRenderer($track);
                }else{
                    $r = new AlbumTrackRenderer($track);
                }
                $html .= $r->render(Renderer::COMPACT);
                $html .= "</br>";
            }
            return $html;
        }
        return "Pas de playlist courante actuellement" ;
    }
}
