<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 11:02
 */

require_once ("../Gateway/ConnexionDB.php");
require_once ('../Modele/ListeTachePublicModele.php');
require_once ("../Validation.php");
require_once ("../Modele/TachePublicModele.php");


class VisiteurController
{

    private $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }


    public function chargementTabListTache(){
        $modele = new ListeTachePublicModele();
        $result = $modele->load();

        $modeleTache = new TachePublicModele();
        if($result == null){
            return null;
        }
        foreach ($result as $listTache){
            $list = $modeleTache->read($listTache->getId());
            $listTache->setListTache($list);
        }

        return $result;
    }

    public function ajouterListeTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validListLength($POST['nom']))
            return false;

        $modele = new ListeTachePublicModele();
        $modele->add($POST['nom']);
        return true;
    }

    public function supprimerListeTache($POST){
        $modele = new ListeTachePublicModele();
        $modele->delete($POST['idToDelete']);

        $modeleTache = new TachePublicModele();
        $modeleTache->deleteAll($POST['idToDelete']);
    }

    public function ajouterTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validTaskLength($POST['nom']))
            return false;

        $modele = new TachePublicModele();
        $modele->add($POST['nom'],$POST['id']);
        return true;
    }

    public function completerTache($nom,$idListeTache){
        $modele = new TachePublicModele();
        $modele->completeTask($nom,$idListeTache);
    }

}