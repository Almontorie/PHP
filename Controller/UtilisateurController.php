<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 07/12/18
 * Time: 11:07
 */

require_once("../Modele/UtilisateurModele.php");
require_once ("../Modele/ListeTacheModele.php");
require_once("../Entite/Utilisateur.php");
require_once ("../Validation.php");
require_once ("../Modele/TacheModele.php");

class UtilisateurController
{
    private $utilisateur;
    private $validation;


    public function __construct($action)
    {
        $this->validation = new Validation();


        switch ($action) {

            case "deconnexion":
                session_unset();
                session_destroy();
                header("Location: VueAccueil.php");
                break;

            case "listetache":
                header("Location: VueListeTache.php");
                break;

            case "connexionPseudoMdp":
                $result = $this->connexionUtilisateur($_POST);
                if(!$result) {
                    $error = "Pseudo ou mot de passe incorrect";
                    header("Location: ../Vue/VueConnexion?error=$error");
                }
                else {
                    $_SESSION['pseudo'] = $_POST['pseudo'];
                    header("Location: VueListeTache.php");
                }
                break;

            case "creationListeNom":
                $this->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
                if (! $this->ajouterListeTache($_POST)) {
                    $error = "Nom de la liste invalide (100 caractères max et caractère '|' interdit)";
                    header("Location: ../Vue/VueCreationListe.php?error=$error");
                }
                else
                    header("Location: VueListeTache.php");
                break;

            case "creationTacheNom":
                $this->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
                $POST['nom'] = $_POST['nom'];
                if (! $this->ajouterTache($POST)) {
                    $error = "Nom de la tâche invalide (200 caractères max et caractère '|' interdit)";
                    header("Location: ../Vue/VueCreationTache.php?error=$error");
                }
                else
                    header("Location: VueListeTache.php");
                break;

            case "inscriptionPseudoMdp";
                $result = $this->inscriptionUtilisateur($_POST);
                if(!$result) {
                    $error = "Pseudo déjà utilisé";
                    header("Location: ../Vue/VueInscription.php?error=$error");
                }
                else {
                    header("Location: VueConnexion.php");
                }
                break;

            case "id":
                $_SESSION['id'] = $_POST['id'];
                header("Location: VueCreationTache.php");
                break;

            case "idToDeletePrivate":
                $this->supprimerListeTache($_POST);
                $tab = $this->chargementTabListTache();
                header("Location: VueListeTache.php");
                break;

            case "completerTache":
                if(isset($_POST['checkbox'])) {
                    foreach ($_POST['checkbox'] as $strTache) {
                        $tache = explode("|", $strTache);
                        $this->completerTache($tache[0], $tache[1]);
                    }
                    header("Location: VueListeTache.php");
                }
                break;

            case "accueil":
                header("Location: VueAccueil.php");
                break;

            case "ajoutTache":
                header("Location: VueCreationListe.php");
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }


    public function connexionUtilisateur($POST){
        try {
            $modele = new UtilisateurModele();

            $POST['pseudo'] = $this->validation->validInput($POST['pseudo']);
            $POST['mdp'] = $this->validation->validInput($POST['mdp']);
            $result = $modele->find($POST['pseudo'], $POST['mdp']);
            if($result == NULL)
                return false;
            $this->utilisateur = $result;
            return true;
        }
        catch (PDOException $e){
            throw $e;
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

    public function inscriptionUtilisateur($POST){
        $modele = new UtilisateurModele();

        $POST['pseudo'] = $this->validation->validInput($POST['pseudo']);
        $POST['mdp'] = $this->validation->validInput($POST['mdp']);
        return $modele->create($POST['pseudo'],$POST['mdp']);
    }

    public function chargementTabListTache(){
        $modele = new ListeTacheModele();
        $result = $modele->load($_SESSION['pseudo']);

        $modeleTache = new TacheModele();
        if($result != null) {
            foreach ($result as $listTache) {
                $list = $modeleTache->read($listTache->getId());
                $listTache->setListTache($list);
            }
        }

        $this->utilisateur = new Utilisateur($_SESSION);
        $this->utilisateur->setTabListe($result);
        return $result;
    }

    public function ajouterListeTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validListLength($POST['nom']))
            return false;

        $modele = new ListeTacheModele();
        $modele->add($this->utilisateur->getPseudo(),$POST['nom']);
        return true;
    }

    public function supprimerListeTache($POST){
        $modele = new ListeTacheModele();
        $modele->delete($POST['idToDelete']);

        $modeleTache = new TacheModele();
        $modeleTache->deleteAll($POST['idToDelete']);
    }

    public function ajouterTache($POST){
        $POST['nom'] = $this->validation->validInput($POST['nom']);
        if (! $this->validation->validTaskLength($POST['nom']))
            return false;

        $modele = new TacheModele();
        $modele->add($POST['nom'],$_POST['id']);
        return true;
    }

    public function completerTache($nom,$idListeTache){
        $modele = new TacheModele();
        $modele->completeTask($nom,$idListeTache);
    }


}