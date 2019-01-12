<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 08:12
 */

require_once("../Controller/UtilisateurController.php");

session_start();

if(!isConnected())
    header ("Location: VueConnexion.php");

?>
<form method="post">
<?php

try {
    $user = new UtilisateurController();
    $user->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
    echo $_SESSION['pseudo'];
    echo "<br/>";
    echo "<br/>";

    $tab = $user->chargementTabListTache();
    affichTab($tab);

    if(isset($_POST['id'])){
        $_SESSION['id'] = $_POST['id'];
        header("Location: VueCreationTache.php");
    }

    if(isset($_POST['idToDelete'])) {
        $user->supprimerListeTache($_POST);
        $tab = $user->chargementTabListTache();
        header("Location: VueListeTache.php");
    }

    if(isset($_POST['deconnexion'])){
        session_unset();
        session_destroy();
        header("Location: VueAccueil.php");
    }

    if(isset($_POST['completerTache'])){
        echo "<br/>";
        foreach ($_POST['checkbox'] as $strTache){
            $tache = explode(" ",$strTache);
            $user->completerTache($tache[0],$tache[1]);
            echo "<br/>";
        }
        echo "<br/>";
        header("Location: VueListeTache.php");
    }

    echo "<br/>";
} catch (PDOException $e){
    echo $e->getMessage();
}
?>
<?php

function affichTab($tab){
    if ($tab == NULL) {
        echo "Aucune liste de tâche";
        echo "<br/>";
    } else {
        foreach ($tab as $item) {
            echo $item->getNom();
            ?>
            <button type="submit" name="id" value="<?php echo $item->getId() ?>">Ajouter une tâche</button>
            <button type="submit" name="idToDelete" value="<?php echo $item->getId() ?>">Supprimer</button>
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
                <input type="checkbox" name="checkbox[]" value="<?php echo $tache->getNom()." ".$item->getId() ?>"/>
                <?php
                echo "<br/>";
            }

            echo "<br/>";
        }
    }
}

function isConnected(){
    if(isset($_SESSION['pseudo']))
        return true;
    return false;
}

?>
    <input type="submit" name="completerTache" value="Valider les tâches" />
    <br/>
    <br/>
    <button type="submit" name="deconnexion">Deconnexion</button>
</form>


<button onclick="window.location.href='VueCreationListe.php'">Ajouter une liste de tâche</button>
<br/>
<br/>
<button onclick="window.location.href='VueAccueil.php'">Accueil</button>
