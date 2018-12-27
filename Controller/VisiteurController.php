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
        $modele->delete($POST['id']);
    }

}