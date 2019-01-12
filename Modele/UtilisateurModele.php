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

    public function __construct()
    {
    }

    public function find($pseudo, $mdp){
        try {
            $utilisateurGateway = new UtilisateurGateway();
            $utilisateur = $utilisateurGateway->read($pseudo, $mdp);
            return $utilisateur;
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function create($pseudo,$mdp){
        try{
            $utilisateurGateway = new UtilisateurGateway();
            $result = $utilisateurGateway->add($pseudo,$mdp);
            return $result;
        }
        catch (PDOException $e){
            throw $e;
        }

    }
}