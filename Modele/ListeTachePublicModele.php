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
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function load(){
        try {
            $listTachePublicGateway = new ListeTachePublicGateway($this->con);
            $tabLisTachePublic = $listTachePublicGateway->read();

            $tacheGateway = new TachePublicGateway($this->con);
            foreach ($tabLisTachePublic as $listeTache){
                $result = $tacheGateway->read($listeTache->getId());
                $listeTache->setListTache($result);
            }

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