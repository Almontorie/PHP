<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:53
 */

require_once ("../Entite/ListeTache.php");

class ListeTachePublicGateway
{
    private $con;

    public function __construct(ConnexionDB $con)
    {
        $this->con = $con;
    }

    function read()
    {
        try {
            $query = 'SELECT * FROM ListeTachePublic';
            $this->con->executeQuery($query);
            if ($this->con->getRowCount() == 0)
                return NULL;
            $result = $this->con->getResults();
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
            $query = 'INSERT INTO ListeTachePublic (nom) VALUES (:nom)';
            $this->con->executeQuery($query, array(
                ':nom' => array($nom, PDO::PARAM_STR)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $query = 'DELETE FROM ListeTachePublic WHERE id = :id';
            $this->con->executeQuery($query, array(
                ':id' => array($id, PDO::PARAM_INT)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

}