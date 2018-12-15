<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 07:44
 */

require_once ("../Entite/ListeTache.php");
require_once ("../Gateway/ListeTacheGateway.php");

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

    }
}