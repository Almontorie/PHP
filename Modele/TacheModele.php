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

    public function __construct()
    {
    }

    public function add($nom,$idListeTache){
        try {
            $tacheGateway = new TacheGateway();
            $tacheGateway->add($nom,$idListeTache);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function read($idListeTache){
        try{
            $tacheGateway = new TacheGateway();
            return $tacheGateway->read($idListeTache);

        } catch (PDOException $e){
            throw $e;
        }
    }

    public function deleteAll($idListeTache){
        try{
            $tacheGateway = new TacheGateway();
            $tacheGateway->deleteAll($idListeTache);

        } catch (PDOException $e){
            throw $e;
        }
    }

    public function completeTask($nom,$idListeTache){
        $tacheGateway = new TacheGateway();
        $tacheGateway->completeTask($nom,$idListeTache);
    }

}