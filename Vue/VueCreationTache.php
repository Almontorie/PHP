<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 27/12/2018
 * Time: 21:40
 */

require_once ("../Controller/UtilisateurController.php");

session_start();

if(!isConnected())
    header ("Location: VueConnexion.php");

$POST['id'] = $_SESSION['id'];
?>

<FORM METHOD="post">
    Nom de la liste : <INPUT TYPE=text name="nom">
    <P>
        <INPUT TYPE=SUBMIT NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {
    if(isset($_POST['nom'])) {
        $user = new UtilisateurController();
        $user->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
        $POST['nom'] = $_POST['nom'];
        if (! $user->ajouterTache($POST))
            echo "Nom de la liste invalide (200 caractères max)";
        else
            header("Location: VueListeTache.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

function isConnected(){
    if(isset($_SESSION['pseudo']))
        return true;
    return false;
}

?>

<button onclick="window.location.href='VueListeTache.php'">Retour</button>

