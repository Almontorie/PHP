<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="../style/stylesheet.css" rel="stylesheet">
<link href="../bootstrap-3.3.7-dist/css/sticky-footer.css" rel="stylesheet">
<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 08:12
 */

require_once("../Controller/FrontController.php");

session_start();

if(!isConnected())
    header ("Location: VueConnexion.php");

?>
<form method="post">

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
                    <li><button class="btn btn-default navbar-btn" type="submit" name="accueil" onclick="window.location.href='VueAccueil.php'">Accueil</button></li>
                    <li><button class="btn btn-default navbar-btn" type="submit" name="deconnexion">Deconnexion</button></li>
                </ul>
            </div>
        </nav>
    </div>

    <h1>Liste de tâches privées</h1>

    <?php

    try {
        $action = "";

        if(isset($_POST['id'])){
            $action = "id";
        }

        if(isset($_POST['idToDelete'])) {
            $action = "idToDeletePrivate";
        }

        if(isset($_POST['deconnexion'])){
            $action = "deconnexion";
        }

        if(isset($_POST['completerTache'])){
            $action = "completerTache";
        }

        if (isset($_POST['accueil'])){
            $action = "accueil";
        }

        if (isset($_POST['ajoutTache'])){
            $action = "ajoutTache";
        }

        $front = new FrontController($action);
        //$front->getController()->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
        $tab = $front->chargementPrivee();
        affichTab($tab);

        echo "<br/>";
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    ?>
    <?php

    function affichTab($tab){
        if ($tab == NULL) {
            echo "<p>Aucune liste de tâche</p>";
            echo "<br/>";
        } else {
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
    }

    function isConnected(){
        if(isset($_SESSION['pseudo']))
            return true;
        return false;
    }

    ?>
    <p>
        <input class="btn btn-success" type="submit" name="completerTache" value="Valider les tâches" />
        <input class="btn btn-default" type="submit" name="ajoutTache" value="Ajouter une liste de tâche" />
    </p>
</form>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Designed by Lucas Torret et Alexis Montorier</p>
    </div>
</footer>