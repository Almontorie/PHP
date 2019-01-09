<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 07/12/18
 * Time: 09:48
 */

require_once("ConnexionDB.php");

class UtilisateurGateway
{
    private $con;

    public  function __construct(ConnexionDB $con)
    {
        $this->con = $con;
    }

    function read($pseudo, $mdp){
        try {
            $query = 'SELECT * FROM utilisateur WHERE pseudo = :pseudo and mdp = :mdp';
            $this->con->executeQuery($query, array(
                ':pseudo' => array($pseudo, PDO::PARAM_STR),
                ':mdp' => array($mdp, PDO::PARAM_STR)));
            if($this->con->getRowCount() == 0)
                return NULL;
            $utilisateur = $this->con->getResults();
            return new Utilisateur($utilisateur[0]['pseudo']);
        }
        catch (PDOException $e) {
            throw $e;
        }
    }
}