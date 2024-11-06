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
use iutnc\deefy\action\DisplayPlaylistsAction;
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
                $html = (new DisplayPlaylistsAction())->execute();
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
        echo $html ;
    }
}