<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 27/12/2018
 * Time: 21:18
 */

require_once ("../Gateway/TacheGateway.php");

class TacheModele
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function add($nom,$idListeTache){
        try {
            $tacheGateway = new TacheGateway($this->con);
            $tacheGateway->add($nom,$idListeTache);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function read($idListeTache){
        try{
            $tacheGateway = new TacheGateway($this->con);
            return $tacheGateway->read($idListeTache);

        } catch (PDOException $e){
            throw $e;
        }
    }

}