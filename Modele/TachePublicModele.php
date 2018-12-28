<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 27/12/2018
 * Time: 21:18
 */

class TachePublicModele
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function add($nom,$idListeTache){
        try {
            $tachePublicGateway = new TachePublicGateway($this->con);
            $tachePublicGateway->add($nom,$idListeTache);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function read($idListeTache){
        try{
            $tachePublicGateway = new TachePublicGateway($this->con);
            return $tachePublicGateway->read($idListeTache);

        } catch (PDOException $e){
            throw $e;
        }
    }

    public function deleteAll($idListeTache){
        try{
            $tachePublicGateway = new TachePublicGateway($this->con);
            $tachePublicGateway->deleteAll($idListeTache);

        } catch (PDOException $e){
            throw $e;
        }
    }

}