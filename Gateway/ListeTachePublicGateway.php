<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:53
 */

require_once ("../Entite/ListeTache.php");
require_once ("Gateway.php");


class ListeTachePublicGateway extends Gateway
{
    public function __construct()
    {
        parent::__construct();
    }


    function read()
    {
        try {
            $query = 'SELECT * FROM listetachepublic';
            $this->connexion->executeQuery($query);
            if ($this->connexion->getRowCount() == 0)
                return NULL;
            $result = $this->connexion->getResults();
            foreach ($result as $row){
                $tabListTache[] = new ListeTache($row['nom'],false,$row['id']);
            }
            return $tabListTache;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function add($nom){
        try {
            $query = 'INSERT INTO listetachepublic (nom) VALUES (:nom)';
            $this->connexion->executeQuery($query, array(
                ':nom' => array($nom, PDO::PARAM_STR)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $query = 'DELETE FROM listetachepublic WHERE id = :id';
            $this->connexion->executeQuery($query, array(
                ':id' => array($id, PDO::PARAM_INT)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

}