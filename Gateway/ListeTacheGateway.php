<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 07:30
 */
require_once("ConnexionDB.php");

class ListeTacheGateway
{
    private $con;

    public function __construct(ConnexionDB $con)
    {
        $this->con = $con;
    }

    function read($pseudo)
    {
        try {
            $query = 'SELECT * FROM listetache WHERE pseudo = :pseudo';
            $this->con->executeQuery($query, array(
                ':pseudo' => array($pseudo, PDO::PARAM_STR)));
            if ($this->con->getRowCount() == 0)
                return NULL;
            $result = $this->con->getResults();

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
            $this->con->executeQuery($query, array(
                ':nom' => array($nom, PDO::PARAM_STR),
                ':pseudo' => array($pseudo, PDO::PARAM_STR)));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete($id){
        try {
            $query = 'DELETE FROM listetache WHERE id = :id';
            $this->con->executeQuery($query, array(
                ':id' => array($id, PDO::PARAM_INT)));
        } catch (PDOException $e) {
            throw $e;
        }
    }
}