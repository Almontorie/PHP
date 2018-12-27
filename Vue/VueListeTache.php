<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 08:12
 */

require_once("../Controller/UtilisateurController.php");

session_start();

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

    echo "<br/>";
} catch (PDOException $e){
    echo $e->getMessage();
}
?>
</form>
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
                echo " - " . $tache->getNom();
                echo "<br/>";
            }

            echo "<br/>";
        }
    }
}

?>


<button onclick="window.location.href='VueCreationListe.php'">Ajouter une liste de tâche</button>
