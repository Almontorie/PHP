<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:48
 */

require_once ("../Controller/VisiteurController.php");
require_once ("../Validation.php");

$user = new VisiteurController();
$tab = $user->chargementTabListTache();

foreach ($tab as $item) {
    echo $item->getNom();
    echo "<br/>";
    foreach ($item->getListTache() as $tache) {
        echo " - ".$tache->getNom();
        echo "<br/>";
    }
    echo "<br/>";
}

?>

<button onclick="window.location.href='VueCreationListePublic.php'">Ajouter une liste de tâche publique</button>

