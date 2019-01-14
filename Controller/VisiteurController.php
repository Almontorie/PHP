<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 11:02
 */

require_once ("../Gateway/ConnexionDB.php");
require_once ('../Modele/ListeTachePublicModele.php');
require_once ("../Validation.php");
require_once ("../Modele/TachePublicModele.php");

class VisiteurController
{

    private $validation;

    public function __construct($action)
    {
        $this->validation = new Validation();


        switch ($action){

            case "id":
                $_SESSION['id'] = $_POST['id'];
                header("Location: VueCreationTachePublic.php");
                break;

            case "idToDelete":
                $this->supprimerListeTache($_POST);
                header("Location: VueAccueil.php");
                break;


            case "connexion":
                header("Location: VueConnexion.php");
                break;


            case "completerTache":
                if(isset($_POST['checkbox'])) {
                    foreach ($_POST['checkbox'] as $strTache) {
                        $tache = explode("|", $strTache);
                        $this->completerTache($tache[0], $tache[1]);
                    }
                    header("Location: VueAccueil.php");
                }
                break;

            case "inscription":
                header("Location: VueInscription.php");
                break;

            case "ajouterListe":
                header("Location: VueCreationListePublic.php");
                break;

            case "creationListePubliqueNom":
                if (! $this->ajouterListeTache($_POST)) {
                    $error = "Nom de la liste invalide (100 caractères max et caractère '|' interdit)";
                    header("Location: ../Vue/VueCreationListePublic.php?error=$error");
                }
                else
                    header("Location: VueAccueil.php");
                break;

            case "creationTachePubliqueNom":
                $POST['nom'] = $_POST['nom'];
                if (! $this->ajouterTache($POST)) {
                    $error = "Nom de la tâche invalide (200 caractères max et caractère '|' interdit)";
                    header("Location: ../Vue/VueCreationTachePublic.php?error=$error");
                }
                else
                    header("Location: VueAccueil.php");
                break;
            default:
        }
    }


    public function chargementTabListTachePublique(){
        $modele = new ListeTachePublicModele();
        $result = $modele->load();

        $modeleTache = new TachePublicModele();
        if($result == null){
            return null;
        }
        foreach ($result as $listTache){
            $list = $modeleTache->read($listTache->getId());
            $listTache->setListTache($list);
        }

        return $result;
    }

    public function ajouterListeTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validListLength($POST['nom']))
            return false;

        $modele = new ListeTachePublicModele();
        $modele->add($POST['nom']);
        return true;
    }

    public function supprimerListeTache($POST){
        $modele = new ListeTachePublicModele();
        $modele->delete($POST['idToDelete']);

        $modeleTache = new TachePublicModele();
        $modeleTache->deleteAll($POST['idToDelete']);
    }

    public function ajouterTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validTaskLength($POST['nom']))
            return false;

        $modele = new TachePublicModele();
        $modele->add($POST['nom'],$_POST['id']);
        return true;
    }

    public function completerTache($nom,$idListeTache){
        $modele = new TachePublicModele();
        $modele->completeTask($nom,$idListeTache);
    }

}