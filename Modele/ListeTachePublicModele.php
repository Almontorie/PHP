<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:56
 */

require_once ("../Gateway/ListeTachePublicGateway.php");
require_once ("../Gateway/TachePublicGateway.php");

class ListeTachePublicModele
{

    public function __construct()
    {
    }

    public function load(){
        try {
            $listTachePublicGateway = new ListeTachePublicGateway();
            $tabLisTachePublic = $listTachePublicGateway->read();
            return $tabLisTachePublic;
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function add($nom){
        try {
            $listTachePublicGateway = new ListeTachePublicGateway();
            $listTachePublicGateway->add($nom);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function delete($id){
        try {
            $listTachePublicGateway = new ListeTachePublicGateway();
            $listTachePublicGateway->delete($id);
        }
        catch (PDOException $e){
            throw $e;
        }
    }
}