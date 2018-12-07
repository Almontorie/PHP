<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 08:47
 */

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


    function insert($tache){
        try {
            $con = connexion();
            $query = 'INSERT into Tache values(:des,NULL)';
            $con->executeQuery($query, array(
                ':des' => array($tache->getNom(), PDO::PARAM_STR)));
        }
        catch (PDOException $e) {
            throw $e;
        }
    }

}