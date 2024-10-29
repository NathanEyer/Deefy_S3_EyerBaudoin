<?php
declare(strict_types = 1);

namespace iutnc\deefy\render;
use iutnc\deefy\audio\tracks\AudioTrack;

/**
 * Affiche une piste audio au format HTML
 */
abstract class AudioTrackRenderer implements Renderer{
    //Attribut à afficher
    protected Audiotrack $track;

    /**
     * @param AudioTrack $track
     */
    public function __construct(Audiotrack $track){
        $this->track = $track;
    }

    /**
     * @param int $selector
     * @return string
     */
    public function render(int $selector) : string{
        $html = "<audio controls><source src=    ";
        switch($selector){
            default:
            case Renderer::COMPACT:
                $html .= $this->renderCompact();
                break;
            case Renderer::LONG:
                $html .= $this->renderLong();
                break;
        }
        return $html;
    }

    /**
     * Affichage compact
     * @return string
     */
    protected abstract function renderCompact() : string;

    /**
     * Affichage long
     * @return string
     */
    protected abstract function renderLong() : string;
}