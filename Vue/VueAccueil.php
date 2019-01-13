<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="../style/stylesheet.css" rel="stylesheet">
<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:48
 */

require_once ("../Controller/VisiteurController.php");
require_once ("../Validation.php");

session_start();


?>
<form method="post">

    <?php
    if(!isConnected()) {
        ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">To Do List</a>
                </div>
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li><button class="btn btn-default navbar-btn" type="submit" name="connexion">Connexion</button></li>
                        <li><button class="btn btn-default navbar-btn" type="submit" name="inscription">S'inscrire</button></li>
                    </ul>
                </div>
            </nav>
        </div>

        <h1>Liste de tâches publiques</h1>
        <br>
    <?php
    }
    else {
        ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">To Do List</a>
                </div>
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a>
                                <?php
                                echo "Utilisateur : ".$_SESSION['pseudo'];
                                ?>
                            </a>
                        </li>
                        <li><button class="btn btn-default navbar-btn" type="submit" name="listetache">Voir mes listes de tâches</button></li>
                        <li><button class="btn btn-default navbar-btn" type="submit" name="deconnexion">Deconnexion</button></li>
                    </ul>
                </div>
            </nav>
        </div>

        <h1>Liste de tâches publiques</h1>
        <br>
        <?php
    }
    ?>

    <?php

    try {
        $user = new VisiteurController();
        $tab = $user->chargementTabListTache();


        affichTab($tab);

        if(isset($_POST['id'])){
            $_SESSION['id'] = $_POST['id'];
            header("Location: VueCreationTachePublic.php");
        }

        if(isset($_POST['idToDelete'])) {
            $user->supprimerListeTache($_POST);
            $tab = $user->chargementTabListTache();
            header("Location: VueAccueil.php");
        }

        if(isset($_POST['connexion'])) {
            header("Location: VueConnexion.php");
        }

        if(isset($_POST['deconnexion'])) {
            session_unset();
            session_destroy();
            header("Location: VueAccueil.php");
        }

        if(isset($_POST['listetache'])){
            if(isConnected())
                header("Location: VueListeTache.php");
            else
                echo "Vous devez tout d'abord vous connecter";
        }

        if(isset($_POST['completerTache'])){
            echo "<br/>";
            foreach ($_POST['checkbox'] as $strTache){
                $tache = explode("|",$strTache);
                $user->completerTache($tache[0],$tache[1]);
                echo "<br/>";
            }
            echo "<br/>";
            header("Location: VueAccueil.php");
        }

        if(isset($_POST['inscription'])){
            header("Location: VueInscription.php");
        }

        if(isset($_POST['ajoutListe'])){
            header("Location: VueCreationListePublic.php");
        }


    } catch (PDOException $e){
        echo $e->getMessage();
    }
    ?>
    <?php

    function affichTab($tab){
        if($tab == null){
            echo "<p>Pas de tâche publique</p>";
            return;
        }
        ?>
        <p>
            <?php
                foreach ($tab as $item) {
                    echo $item->getNom();
                    ?>
                    <button class="btn btn-default" type="submit" name="id" value="<?php echo $item->getId() ?>">Ajouter une tâche</button>
                    <button class="btn btn-danger" type="submit" name="idToDelete" value="<?php echo $item->getId() ?>">Supprimer</button>
                    <?php
                    echo "<br/>";
                    foreach ($item->getListTache() as $tache) {
                        if($tache->isComplete()) {
                            echo " - ";
                            ?>
                            <s><?php echo $tache->getNom()?></s>
                            <?php
                        }
                        else {
                            echo " - " . $tache->getNom();
                        }
                        ?>
                        <input type="checkbox" name="checkbox[]" value="<?php echo $tache->getNom()."|".$item->getId() ?>"/>
                        <?php
                        echo "<br/>";
                    }
                    echo "<br/>";
                }
            ?>
        </p>
        <?php
    }

    function isConnected(){
        if(isset($_SESSION['pseudo']))
            return true;
        return false;
    }

    ?>

    <p>
        <br>
        <input class="btn btn-success" type="submit" name="completerTache" value="Valider les tâches" />
        <input class="btn btn-default" type="submit" name="ajoutListe" value="Ajouter une liste de tâche publique" />
    </p>
</form>
