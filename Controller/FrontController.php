<?php
/**
 * Created by PhpStorm.
 * User: Alexis
 * Date: 13/01/2019
 * Time: 14:16
 */
require_once ("VisiteurController.php");
require_once ("UtilisateurController.php");


class FrontController
{
    private $controller;

    public function __construct($action)
    {
        if($action == "connexionPseudoMdp" || $action == "inscriptionPseudoMdp"){
            $this->controller = new UtilisateurController($action);
        }
        if ($this->isConnected()){
            $this->controller = new UtilisateurController($action);
        }
        else{
            $this ->controller = new VisiteurController($action);
        }
    }

    /**
     * @return VisiteurController
     */
    public function getController()
    {
        return $this->controller;
    }



    private function isConnected()
    {
        return isset($_SESSION['pseudo']);
    }


}