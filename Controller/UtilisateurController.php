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
require_once ("../Validation.php");
require_once ("../Modele/TacheModele.php");

class UtilisateurController
{
    private $utilisateur;
    private $validation;


    public function __construct()
    {
        $this->validation = new Validation();
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


    public function connexionUtilisateur($POST){
        try {
            $modele = new UtilisateurModele();

            $POST['pseudo'] = $this->validation->validInput($POST['pseudo']);
            $POST['mdp'] = $this->validation->validInput($POST['mdp']);
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

    public function inscriptionUtilisateur($POST){
        $modele = new UtilisateurModele();

        $POST['pseudo'] = $this->validation->validInput($POST['pseudo']);
        $POST['mdp'] = $this->validation->validInput($POST['mdp']);
        return $modele->create($POST['pseudo'],$POST['mdp']);
    }

    public function chargementTabListTache(){
        $modele = new ListeTacheModele();
        $result = $modele->load($this->utilisateur->getPseudo());

        $modeleTache = new TacheModele();
        if($result != null) {
            foreach ($result as $listTache) {
                $list = $modeleTache->read($listTache->getId());
                $listTache->setListTache($list);
            }
        }

        $this->utilisateur->setTabListe($result);
        return $result;
    }

    public function ajouterListeTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validListLength($POST['nom']))
            return false;

        $modele = new ListeTacheModele();
        $modele->add($this->utilisateur->getPseudo(),$POST['nom']);
        return true;
    }

    public function supprimerListeTache($POST){
        $modele = new ListeTacheModele();
        $modele->delete($POST['idToDelete']);

        $modeleTache = new TacheModele();
        $modeleTache->deleteAll($POST['idToDelete']);
    }

    public function ajouterTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validTaskLength($POST['nom']))
            return false;

        $modele = new TacheModele();
        $modele->add($POST['nom'],$POST['id']);
        return true;
    }

    public function completerTache($nom,$idListeTache){
        $modele = new TacheModele();
        $modele->completeTask($nom,$idListeTache);
    }


}