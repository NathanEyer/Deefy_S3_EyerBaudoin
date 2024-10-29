<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddAlbumTrackAction;
use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\DisplayPlaylistsAction;


class Dispatcher
{
    private $action;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? 'default';
    }

    public function run(): void{
        switch($this->action){
            case 'default':
                $html = (new DefaultAction)->execute();
                break;
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
        }
        $this->renderPage($html);
    }

    private function renderPage(string $html) : void {
        echo $html ;
    }
}