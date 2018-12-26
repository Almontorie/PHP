<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 11:02
 */

require_once ("../Gateway/ConnexionDB.php");
require_once ('../Modele/ListeTachePublicModele.php');

class VisiteurController
{

    public function __construct()
    {

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
        if($result == NULL)
            return NULL;
        return $result;
    }

    public function ajouterListeTache($POST){
        $con=$this->connexion();
        $modele = new ListeTachePublicModele($con);
        $modele->add($POST['nom']);
    }

    public function supprimerListeTache($POST){
        $con=$this->connexion();
        $modele = new ListeTachePublicModele($con);
        $modele->delete($POST['id']);
    }

}