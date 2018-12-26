<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 07/12/18
 * Time: 11:07
 */

require_once("../Modele/UtilisateurModele.php");
require_once ("../Modele/ListeTacheModele.php");
require_once("../Entite/Utilisateur.php");

class UtilisateurController
{
    private $utilisateur;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }



    private function connexion() {
        try {
            $dsn = "mysql:host=localhost;dbname=dbalmontorie";
            $user = "root";
            $passwd = "";
            return new ConnexionDB($dsn, $user, $passwd);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function connexionUtilisateur($POST){
        try {
            $con = $this->connexion();
            $modele = new UtilisateurModele($con);
            $result = $modele->find($POST['pseudo'], $POST['mdp']);
            if($result == NULL)
                return false;
            $this->utilisateur = $result;
            return true;
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function chargementTabListTache(){
        $con=$this->connexion();
        $modele = new ListeTacheModele($con);
        $result = $modele->load($this->utilisateur->getPseudo());
        if($result == NULL)
            return NULL;
        $this->utilisateur->setTabListe($result);
        return $result;
    }

    public function ajouterListeTache($POST){
        $con=$this->connexion();
        $modele = new ListeTacheModele($con);
        $modele->add($this->utilisateur->getPseudo(),$POST['nom']);
    }

    public function supprimerListeTache($POST){
        $con=$this->connexion();
        $modele = new ListeTacheModele($con);
        $modele->delete($POST['id']);
    }

}