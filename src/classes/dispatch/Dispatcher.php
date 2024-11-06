<?php
declare(strict_types = 1);

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddAlbumTrackAction;
use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DelPlaylistAction;
use iutnc\deefy\action\DisplayAllPodcastAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\DisplayAllPlaylistAction;
use iutnc\deefy\action\DisplayAllTrackAction;
use iutnc\deefy\action\SigninAction;
use iutnc\deefy\action\LoginAction;
use iutnc\deefy\action\LogOutAction;


class Dispatcher
{
    private $action;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? 'default';
    }

    public function run(): void{
        switch($this->action){
            case 'show-playlist':
                $html = (new DisplayPlaylistAction())->execute();
                break;
            case 'show-playlists':
                $html = (new DisplayAllPlaylistAction())->execute();
                break;
            case 'add-playlist':
                $html = (new AddPlaylistAction())->execute();
                break;
            case 'add-podcasttrack':
                $html = (new AddPodcastTrackAction())->execute();
                break;
            case 'add-albumtrack':
                $html = (new AddAlbumTrackAction())->execute();
                break;
            case 'show-tracks':
                $html = (new DisplayAllTrackAction())->execute();
                break;
            case 'show-podcasts':
                $html = (new DisplayAllPodcastAction())->execute();
                break;
            case 'signin':
                $html = (new SigninAction())->execute();
                break;

            case 'login':
                $html = (new LoginAction())->execute();
                break;
            case 'logout':
                $html = (new LogOutAction())->execute();
                break;

            case 'delete-playlist':
                $html = (new DelPlaylistAction())->execute();

                break;
            default :
                $html = (new DefaultAction)->execute();
                break;
        }
        $this->renderPage($html);
    }

    private function renderPage(string $html) : void {
        echo "<!DOCTYPE html><html lang=\"fr\"><head><meta charset=\"utf-8\"><meta name=\"viewport\"
            content=\"width=device-width, initial-scale=1\"><title>Deefy</title></head><body>
            <div style=\"background-color: #007bff; padding: 15px; text-align: center; color: white;\">
            <a href=\"index.php\" style=\"margin: 0 15px; color: white; text-decoration: none;\">Page d'accueil</a>
            <a href=\"index.php?action=show-playlist\" style=\"margin: 0 15px; color: white; text-decoration: none;\">Afficher la playlist courante</a>
            <a href=\"index.php?action=show-playlists\" style=\"margin: 0 15px; color: white; text-decoration: none;\">Afficher toutes les playlists</a>
            <a href=\"index.php?action=show-tracks\" style=\"margin: 0 15px; color: white; text-decoration: none;\">Afficher tous les tracks</a>
            <a href=\"index.php?action=show-podcasts\" style=\"margin: 0 15px; color: white; text-decoration: none;\">Afficher tous les podcasts</a>
            <a href=\"index.php?action=signin\" style=\"margin: 0 15px; color: white; text-decoration: none;\">S\'inscrire</a>
            <a href=\"index.php?action=login\" style=\"margin: 0 15px; color: white; text-decoration: none;\">Se connecter</a>
            <a href=\"index.php?action=logout\" style=\"margin: 0 15px; color: white; text-decoration: none;\">Se déconnecter</a>
            </div>" . $html . "</body></html>";
    }
}