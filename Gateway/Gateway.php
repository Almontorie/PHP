<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 12/01/19
 * Time: 07:52
 */

class Gateway
{

    protected $connexion;

    protected function __construct(){
        $this->connexion = $this->connexion();
    }

    private function connexion() {
        try {
            $dsn = "mysql:host=localhost;dbname=dbalmontorie";
            $user = "almontorie";
            $passwd = "almontoriemdp";
            return new ConnexionDB($dsn, $user, $passwd);
        }
        catch (PDOException $e){
            throw $e;
        }
    }

}