<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:56
 */

class ListeTachePublicModele
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function load(){
        try {
            $listTachePublicGateway = new ListeTachePublicGateway($this->con);
            $tabLisTachePublic = $listTachePublicGateway->read();
            return $tabLisTachePublic;
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function add($nom){
        try {
            $listTachePublicGateway = new ListeTachePublicGateway(($this->con));
            $listTachePublicGateway->add($nom);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function delete($id){
        try {
            $listTachePublicGateway = new ListeTachePublicGateway(($this->con));
            $listTachePublicGateway->delete($id);
        }
        catch (PDOException $e){
            throw $e;
        }
    }
}