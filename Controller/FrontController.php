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


        if(in_array($action,["","id","idPublic","idToDelete","connexion","completerTachePublique","inscription","ajouterListePublique","creationListePubliqueNom","creationTachePubliqueNom"])){
            if(!$this->isConnected()) {
                $this->controller = new VisiteurController($action);
                return;
            }
            elseif(in_array($action, ["ajouterListePublique","creationListePubliqueNom","idToDelete","completerTachePublique","idPublic","creationTachePubliqueNom"])){
                $this->controller = new VisiteurController($action);
                return;
            }
            else{
                $this->controller = new UtilisateurController($action);
                return;
            }
        }

        if(in_array($action, ["","deconnexion","listetache","connexionPseudoMdp","creationListeNom","creationTacheNom","inscriptionPseudoMdp","id","idToDeletePrivate","completerTache","accueil","ajoutTache"])){
            if($this->isConnected()){
                $this->controller = new UtilisateurController($action);
            }
            elseif (in_array($action, ["connexionPseudoMdp","inscriptionPseudoMdp"])){
                $this->controller = new UtilisateurController($action);
            }
            else {
                header("Location: ../Vue/VueConnexion?action");
            }
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

    public function chargement(){
        $controllerTMP = new VisiteurController("");
        return $controllerTMP->chargementTabListTachePublique();
    }

    public function chargementPrivee(){
        $controllerTMP = new UtilisateurController("");
        return $controllerTMP->chargementTabListTache();
    }

}