<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 27/12/2018
 * Time: 21:18
 */

class TachePublicModele
{

    public function __construct()
    {
    }

    public function add($nom,$idListeTache){
        try {
            $tachePublicGateway = new TachePublicGateway();
            $tachePublicGateway->add($nom,$idListeTache);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function read($idListeTache){
        try{
            $tachePublicGateway = new TachePublicGateway();
            return $tachePublicGateway->read($idListeTache);

        } catch (PDOException $e){
            throw $e;
        }
    }

    public function deleteAll($idListeTache){
        try{
            $tachePublicGateway = new TachePublicGateway();
            $tachePublicGateway->deleteAll($idListeTache);

        } catch (PDOException $e){
            throw $e;
        }
    }

    public function completeTask($nom,$idListeTache){
        $tachePublicGateway = new TachePublicGateway();
        $tachePublicGateway->completeTask($nom,$idListeTache);
    }

}