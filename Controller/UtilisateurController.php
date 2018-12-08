<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 07/12/18
 * Time: 11:07
 */

require_once("../Modele/UtilisateurModele.php");

class UtilisateurController
{
    private $utilisateur;

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
            $result = $modele->find($POST['pseudo'], $POST['mdp']);
            if($result == NULL)
                return "Connexion échoué";
            $this->utilisateur = $result;
            return "Bonjour ".$result->__toString();
        }
        catch (PDOException $e){
            throw $e;
        }
    }



}