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

    public function chargementTabListTache(){
        $con=$this->connexion();
        $modele = new ListeTachePublicModele($con);
        $result = $modele->load();

        $modeleTache = new TachePublicModele($con);
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

        $con=$this->connexion();
        $modele = new ListeTachePublicModele($con);
        $modele->add($POST['nom']);
        return true;
    }

    public function supprimerListeTache($POST){
        $con=$this->connexion();
        $modele = new ListeTachePublicModele($con);
        $modele->delete($POST['idToDelete']);

        $modeleTache = new TachePublicModele($con);
        $modeleTache->deleteAll($POST['idToDelete']);
    }

    public function ajouterTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validTaskLength($POST['nom']))
            return false;

        $con = $this->connexion();
        $modele = new TachePublicModele($con);
        $modele->add($POST['nom'],$POST['id']);
        return true;
    }

}