<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="../bootstrap-3.3.7-dist/css/sticky-footer.css" rel="stylesheet">
<link href="../style/stylesheet.css" rel="stylesheet">
<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:48
 */

require_once ("../Controller/FrontController.php");
require_once ("../Validation.php");

session_start();
?>

<body>
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
        try {
            $action = "test";

            if(isset($_POST['id'])){
                $action = "id";
            }

            if(isset($_POST['idToDelete'])) {
                $action = "idToDelete";
            }

            if(isset($_POST['connexion'])) {
                $action = "connexion";
            }

            if(isset($_POST['deconnexion'])) {
                $action = "deconnexion";
            }

            if(isset($_POST['listetache'])){
                if(isConnected())
                    $action = "listetache";
                else
                    echo "Vous devez tout d'abord vous connecter";
            }

            if(isset($_POST['completerTache'])){
                $action = "completerTache";
            }

            if(isset($_POST['inscription'])){
                $action = "inscription";
            }

            if(isset($_POST['ajoutListe'])){
                $action = "ajouterListe";
            }

            $front = new FrontController($action);
            $tab = $front->getController()->chargementTabListTachePublique();

            affichTab($tab);


        } catch (PDOException $e){
            echo $e->getMessage();
        }


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
                        <button class="btn btn-default" type="submit" name="id" value="<?php echo $item->getId()?>">Ajouter une tâche</button>
                        <button class="btn btn-danger" type="submit" name="idToDelete" value="<?php echo $item->getId()?>">Supprimer</button>
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
                            <input type="checkbox" name="checkbox[]" value="<?php echo $tache->getNom()."|".$item->getId()?>"/>
                            <?php
                            echo "<br/>";
                        }
                        echo "<br/>";
                    }
                ?>
            </p>
            <?php
        }

        function isConnected()
        {
            if (isset($_SESSION['pseudo']))
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

    <footer class="footer">
        <div class="container">
            <p class="text-muted">Designed by Lucas Torret et Alexis Montorier</p>
        </div>
    </footer>
</body>
