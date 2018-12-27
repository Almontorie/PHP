<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:48
 */

require_once ("../Controller/VisiteurController.php");
require_once ("../Validation.php");

?>
<form method="post">
<?php

try {
    $user = new VisiteurController();
    $tab = $user->chargementTabListTache();

    affichTab($tab);

    if(isset($_POST['id'])) {
        $user->supprimerListeTache($_POST);
        $tab = $user->chargementTabListTache();
        header("Location: VueAccueil.php");
    }

} catch (PDOException $e){
    echo $e->getMessage();
}
?>
</form>
<?php

function affichTab($tab){
    foreach ($tab as $item) {
        echo $item->getNom();
        ?>
        <button type="submit" name="id" value="<?php echo $item->getId() ?>">Supprimer</button>
        <?php
        echo "<br/>";
        foreach ($item->getListTache() as $tache) {
            echo " - " . $tache->getNom();
            echo "<br/>";
        }
        echo "<br/>";
    }
}

?>

<button onclick="window.location.href='VueCreationListePublic.php'">Ajouter une liste de tâche publique</button>
