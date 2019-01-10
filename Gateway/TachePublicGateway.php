<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 08:47
 */

require_once("ConnexionDB.php");
require_once("../Entite/Tache.php");


class TachePublicGateway
{

    private $con;

    /**
     * TacheGateway constructor.
     * @param $con
     */
    public function __construct($con)
    {
        $this->con = $con;
    }


    function add($nom,$idListeTache){
        try {
            $query = 'INSERT into tachepublic values(:des,:id,false)';
            $this->con->executeQuery($query, array(
                ':des' => array($nom, PDO::PARAM_STR),
                ':id' => array($idListeTache, PdO::PARAM_INT)));
        }
        catch (PDOException $e) {
            throw $e;
        }
    }

    function read($idListeTache){
        try {
            $tabTache = [];
            $query = 'SELECT * FROM tachepublic WHERE idListeTache = :id';
            $this->con->executeQuery($query, array(
                ':id' => array($idListeTache, PDO::PARAM_STR)));
            $result = $this->con->getResults();
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
            $query = 'DELETE FROM tachepublic WHERE idListeTache = :idListeTache and nom = :nom';
            $this->con->executeQuery($query, array(
                ':idListeTache' => array($idListeTache, PDO::PARAM_INT),
                ':nom' => array($nom, PDO::PARAM_STR)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function deleteAll($idListeTache){
        try{
            $query = 'DELETE FROM tachepublic WHERE idListeTache = :idListeTache';
            $this->con->executeQuery($query, array(
                ':idListeTache' => array($idListeTache, PDO::PARAM_INT)));
        } catch (PDOException $e){
            throw $e;
        }
    }

    function completeTask($nom,$idListeTache){
        try {
            $query = 'UPDATE tachepublic SET complete=true WHERE nom = :nom and idListeTache = :idListeTache';
            $this->con->executeQuery($query, array(
                ':nom' => array($nom, PDO::PARAM_STR),
                ':idListeTache' => array($idListeTache, PDO::PARAM_INT)));

        } catch (PDOException $e){
            throw $e;
        }
    }

}