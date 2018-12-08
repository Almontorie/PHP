<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 07/12/18
 * Time: 10:51
 */

require_once ("../Gateway/UtilisateurGateway.php");
require_once ("../Entite/Utilisateur.php");

class UtilisateurModele
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function find($pseudo, $mdp){
        try {
            $utilisateurGateway = new UtilisateurGateway($this->con);
            $utilisateur = $utilisateurGateway->read($pseudo, $mdp);
            return $utilisateur;
        }
        catch (PDOException $e){
            throw $e;
        }
    }
}