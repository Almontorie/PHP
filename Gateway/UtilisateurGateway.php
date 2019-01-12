<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 07/12/18
 * Time: 09:48
 */

require_once("ConnexionDB.php");
require_once ("Gateway.php");


class UtilisateurGateway extends Gateway
{

    public function __construct()
    {
        parent::__construct();
    }


    function read($pseudo, $mdp){
        try {
            $query = 'SELECT * FROM utilisateur WHERE pseudo = :pseudo';
            $this->connexion->executeQuery($query, array(
                ':pseudo' => array($pseudo, PDO::PARAM_STR)));
            if($this->connexion->getRowCount() == 0)
                return NULL;

            $utilisateur = $this->connexion->getResults();
            if (!password_verify($mdp,$utilisateur[0]['mdp'])){
                return NULL;
            }
            return new Utilisateur($utilisateur[0]['pseudo']);
        }
        catch (PDOException $e) {
            throw $e;
        }
    }

    function add($pseudo,$mdp){
        try {
            $query = 'SELECT * FROM utilisateur WHERE pseudo = :pseudo';
            $this->connexion->executeQuery($query, array(
                ':pseudo' => array($pseudo, PDO::PARAM_STR)));
            if($this->connexion->getRowCount() != 0)
                return false;

            $query = 'INSERT INTO utilisateur VALUES (:pseudo,:mdp)';
            $mdp = password_hash($mdp,PASSWORD_BCRYPT);
            $this->connexion->executeQuery($query, array(
                ':pseudo' => array($pseudo, PDO::PARAM_STR),
                ':mdp' => array($mdp, PDO::PARAM_STR)));
            return true;
        }
        catch (PDOException $e) {
            throw $e;
        }
    }
}