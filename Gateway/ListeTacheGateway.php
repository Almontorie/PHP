<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 07:30
 */
require_once("ConnexionDB.php");
require_once ("Gateway.php");


class ListeTacheGateway extends Gateway
{
    public function __construct()
    {
        parent::__construct();
    }

    function read($pseudo)
    {
        try {
            $query = 'SELECT * FROM listetache WHERE pseudo = :pseudo';
            $this->connexion->executeQuery($query, array(
                ':pseudo' => array($pseudo, PDO::PARAM_STR)));
            if ($this->connexion->getRowCount() == 0)
                return NULL;
            $result = $this->connexion->getResults();

            foreach ($result as $row){
                $tabListTache[] = new ListeTache($row['nom'],true,$row['id']);
            }
            return $tabListTache;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function add($pseudo, $nom){
        try {
            $query = 'INSERT INTO listetache (nom, pseudo) VALUES (:nom, :pseudo)';
            $this->connexion->executeQuery($query, array(
                ':nom' => array($nom, PDO::PARAM_STR),
                ':pseudo' => array($pseudo, PDO::PARAM_STR)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $query = 'DELETE FROM listetache WHERE id = :id';
            $this->connexion->executeQuery($query, array(
                ':id' => array($id, PDO::PARAM_INT)));
        } catch (PDOException $e) {
            throw $e;
        }
    }
}