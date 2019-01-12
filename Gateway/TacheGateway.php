<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 08:47
 */

require_once("ConnexionDB.php");
require_once("../Entite/Tache.php");
require_once ("Gateway.php");


class TacheGateway extends Gateway
{

    public function __construct()
    {
        parent::__construct();
    }


    function add($nom,$idListeTache){
        try {
            $query = 'INSERT into tache values(:des,:id,false)';
            $this->connexion->executeQuery($query, array(
                ':des' => array($nom, PDO::PARAM_STR),
                ':id' => array($idListeTache, PDO::PARAM_INT)));
        }
        catch (PDOException $e) {
            throw $e;
        }
    }

    function read($idListeTache){
        try {
            $tabTache = [];
            $query = 'SELECT * FROM tache WHERE idListeTache = :id';
            $this->connexion->executeQuery($query, array(
                ':id' => array($idListeTache, PDO::PARAM_INT)));
            $result = $this->connexion->getResults();
            foreach ($result as $row) {
                $tabTache[] = new Tache($row['nom'],$row['complete']);
            }
            return $tabTache;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function delete($nom,$idListeTache){
        try {
            $query = 'DELETE FROM tache WHERE idListeTache = :idListeTache and nom = :nom';
            $this->connexion->executeQuery($query, array(
                ':idListeTache' => array($idListeTache, PDO::PARAM_INT),
                ':nom' => array($nom, PDO::PARAM_STR)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function deleteAll($idListeTache){
        try{
            $query = 'DELETE FROM tache WHERE idListeTache = :id';
            $this->connexion->executeQuery($query, array(
                ':id' => array($idListeTache, PDO::PARAM_INT)));
        } catch (PDOException $e){
            throw $e;
        }
    }

    function completeTask($nom,$idListeTache){
        try {
            $query = 'UPDATE tache SET complete=true WHERE nom = :nom and idListeTache = :idListeTache';
            $this->connexion->executeQuery($query, array(
                ':nom' => array($nom, PDO::PARAM_STR),
                ':idListeTache' => array($idListeTache, PDO::PARAM_INT)));

        } catch (PDOException $e){
            throw $e;
        }
    }

}