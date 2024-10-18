<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;

class Dispatcher
{
    private $action;

    /**
     * @param $action
     */
    public function __construct()
    {
        $this->action = $_GET['action'];
    }

    public function run(): void{
        switch($this->action){
            case 'default':
                (new DefaultAction)->execute();
                break;
            case 'playlist':
                (new DisplayPlaylistAction())->execute();
                break;
            case 'add-playlist':
                (new AddPlaylistAction())->execute();
                break;
            case 'add-track':
                (new AddPodcastTrackAction())->execute();
                break;
        }
    }
}