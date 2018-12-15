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
    private $tabListe = [];

    /**
     * Utilisateur constructor.
     * @param $pseudo
     * @param $mdp
     */
    public function __construct($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @return mixed
     */


    /**
     * @return array
     */
    public function getTabListe()
    {
        return $this->tabListe;
    }

    /**
     * @param array $tabListe
     */
    public function setTabListe($tabListe)
    {
        $this->tabListe = $tabListe;
    }



    public function ajouterListe($liste){
        $this->tabListe[] = $liste;
    }

    public function __toString()
    {
        return $this->pseudo;
    }


}