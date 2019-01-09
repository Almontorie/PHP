<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 08:47
 */

require_once("ConnexionDB.php");
require_once("../Entite/Tache.php");


class TacheGateway
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
            $query = 'INSERT into tache values(:des,:id)';
            $this->con->executeQuery($query, array(
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
            $this->con->executeQuery($query, array(
                ':id' => array($idListeTache, PDO::PARAM_INT)));
            $result = $this->con->getResults();
            foreach ($result as $row) {
                $tabTache[] = new Tache($row['nom']);
            }
            return $tabTache;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function delete($nom,$idListeTache){
        try {
            $query = 'DELETE FROM tache WHERE idListeTache = :idListeTache and nom = :nom';
            $this->con->executeQuery($query, array(
                ':idListeTache' => array($idListeTache, PDO::PARAM_INT),
                ':nom' => array($nom, PDO::PARAM_STR)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function deleteAll($idListeTache){
        try{
            $query = 'DELETE FROM tache WHERE idListeTache = :id';
            $this->con->executeQuery($query, array(
                ':id' => array($idListeTache, PDO::PARAM_INT)));
        } catch (PDOException $e){
            throw $e;
        }
    }


}