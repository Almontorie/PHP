<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 10:43
 */

class Utilisateur
{
    private $pseudo;
    private $mdp;
    private $tabListe = [];

    /**
     * Utilisateur constructor.
     * @param $pseudo
     * @param $mdp
     */
    public function __construct($pseudo, $mdp)
    {
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @return array
     */
    public function getTabListe()
    {
        return $this->tabListe;
    }


    public function ajouterListe($liste){
        $this->tabListe[] = $liste;
    }

}