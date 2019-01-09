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
pour supprimer tache avec checkbox : début : checkbox value = index de la tache dans sa liste de taches (faire compteur dans foreach qui affiche les taches)
mettre champ complete dans la bdd car recharger la page annule le setComplete(true);
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

    if(isset($_POST['checkbox'])){
        echo "<br/>";
        foreach ($_POST['checkbox'] as $tache){
            $index = explode(" ",$tache);
            $list = $tab[$index[1]]->getListTache();
            $list[$index[0]]->setComplete(true);
            echo "<br/>";
        }
        echo "<br/>";
        affichTab($tab);
        //header("Location: VueAccueil.php");
    }


} catch (PDOException $e){
    echo $e->getMessage();
}
?>
<?php

function affichTab($tab){
    $indexList = 0;
    foreach ($tab as $item) {
        echo $item->getNom();
        ?>
        <button type="submit" name="id" value="<?php echo $item->getId() ?>">Ajouter une tâche</button>
        <button type="submit" name="idToDelete" value="<?php echo $item->getId() ?>">Supprimer</button>
        <?php
        echo "<br/>";
        $indexTask = 0;
        foreach ($item->getListTache() as $tache) {
            if($tache->isComplete()) {
                ?>
                <s><?php echo " - ".$tache->getNom()?></s>
                <?php
            }
            else {
                echo " - " . $tache->getNom();
            }
            ?>
            <input type="checkbox" name="checkbox[]" value="<?php echo $indexTask." ".$indexList ?>"/>
            <?php
            echo "<br/>";
            $indexTask++;
        }
        echo "<br/>";
        $indexList++;
    }
}

function isConnected(){
    if(isset($_SESSION['pseudo']) and $_SESSION['pseudo'] != null)
        return true;
    return false;
}

?>

    <input type="submit" value="Valider les tâches" />
    <br/>
    <br/>
    <button type="submit" name="listetache">Voir mes listes de tâches</button>
    <br/>
    <br/>
    <button type="submit" name="connexion">Connexion</button>
    <button type="submit" name="deconnexion">Deconnexion</button>

</form>

<button onclick="window.location.href='VueCreationListePublic.php'">Ajouter une liste de tâche publique</button>
<br/>
<br/>
<button onclick="window.location.href='VueInscription.php'">S'inscrire</button>
