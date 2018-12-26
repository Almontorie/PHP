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


    function add($nom){
        try {
            $con = connexion();
            $query = 'INSERT into Tache values(:des,NULL)';
            $con->executeQuery($query, array(
                ':des' => array($nom, PDO::PARAM_STR)));
        }
        catch (PDOException $e) {
            throw $e;
        }
    }

    function read($idListeTache){
        try {
            $tabTache = [];
            $query = 'SELECT * FROM Tache WHERE idListeTache = :id';
            $this->con->executeQuery($query, array(
                ':id' => array($idListeTache, PDO::PARAM_STR)));
            $result = $this->con->getResults();
            foreach ($result as $row) {
                $tabTache[] = new Tache($row['nom']);
            }
            return $tabTache;
        } catch (PDOException $e) {
            throw $e;
        }
    }


}