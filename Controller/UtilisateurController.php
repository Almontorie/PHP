<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 07/12/18
 * Time: 11:07
 */

require_once("Modele/UtilisateurModele.php");

class UtilisateurController
{
    public function __construct()
    {

    }

    private function connexion() {
        try {
            $dsn = "mysql:host=localhost;dbname=dbalmontorie";
            $user = "almontorie";
            $passwd = "nulmitroglou";
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
            $result = $modele->find($POST[0], $POST[1]);
            if ($result == 1) {
                return "Connecté";
            } else {
                return "Connexion echouée";
            }
        }
        catch (PDOException $e){
            throw $e;
        }
    }



}