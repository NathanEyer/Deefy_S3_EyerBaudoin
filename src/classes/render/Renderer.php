<?php
declare(strict_types = 1);

namespace iutnc\deefy\render;
/**
 * Interface d'affichage HTML des objets
 */
interface Renderer{
    //Attributs du format de l'affichage
    const COMPACT = 1;
    const LONG = 2;

    /**
     * Permettra d'appeler des fonctions
     * d'affichage
     * @param int $selector
     * @return string
     */
    public function render(int $selector) : string;
}