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

/*
 * à faire : -supprimer les tâches quand on supprime la liste
 */


?>
<form method="post">
<?php

try {
    $user = new VisiteurController();
    $tab = $user->chargementTabListTache();

    if(isConnected()) {
        echo "Hello " . $_SESSION['pseudo'];
        echo "<br/>";
    }
    echo "<br/>";

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
        if(isConnected())
            echo "<br/> Vous êtes déjà connecté";
        else
            header("Location: VueConnexion.php");
    }

    if(isset($_POST['deconnexion'])) {
        $_SESSION['pseudo'] = null;
        header("Location: VueAccueil.php");
    }

    if(isset($_POST['listetache'])){
        if(isConnected())
            header("Location: VueListeTache.php");
        else
            echo "Vous devez tout d'abord vous connecter";
    }



} catch (PDOException $e){
    echo $e->getMessage();
}
?>
<?php

function affichTab($tab){
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

function isConnected(){
    if(isset($_SESSION['pseudo']) and $_SESSION['pseudo'] != null)
        return true;
    return false;
}

?>

    <button type="submit" name="connexion">Connexion</button>
    <button type="submit" name="deconnexion">Deconnexion</button>
    <button type="submit" name="listetache">Voir mes listes de tâches</button>


</form>
<button onclick="window.location.href='VueCreationListePublic.php'">Ajouter une liste de tâche publique</button>
