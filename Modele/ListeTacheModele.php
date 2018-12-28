<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 07:44
 */

require_once ("../Entite/ListeTache.php");
require_once ("../Gateway/ListeTacheGateway.php");
require_once ("../Gateway/TacheGateway.php");

class ListeTacheModele
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function load($pseudo){
        try {
            $listTacheGateway = new ListeTacheGateway($this->con);
            $tabLisTache = $listTacheGateway->read($pseudo);
            return $tabLisTache;
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function add($pseudo, $nom){
        try {
            $listTacheGateway = new ListeTacheGateway(($this->con));
            $listTacheGateway->add($pseudo, $nom);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function delete($id){
        try {
            $listTacheGateway = new ListeTacheGateway(($this->con));
            $listTacheGateway->delete($id);
        }
        catch (PDOException $e){
            throw $e;
        }
    }
}