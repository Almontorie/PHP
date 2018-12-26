<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 08:12
 */

require_once("../Controller/UtilisateurController.php");

session_start();

$user = new UtilisateurController();
$user->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
echo $_SESSION['pseudo'];
echo "<br/>";
echo "<br/>";
$tab = $user->chargementTabListTache();
if($tab == NULL){
    echo "Aucune liste de tâche";
    echo "<br/>";
}
else {
    foreach ($tab as $item) {
        echo $item->getNom();
        echo "<br/>";
        foreach ($item->getListTache() as $tache) {
            echo " - ".$tache->getNom();
            echo "<br/>";
        }

        echo "<br/>";
    }
}
echo "<br/>";
?>

<button onclick="window.location.href='VueCreationListe.php'">Ajouter une liste de tâche</button>
