<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 09:30
 */

require_once ("../Controller/UtilisateurController.php");

session_start();

if(!isConnected())
    header ("Location: VueConnexion.php");

?>

<FORM METHOD="post">
    Nom de la liste : <INPUT TYPE=text name="nom"> (100 caractères maximum et caractère '|' interdit)
    <P>
        <INPUT TYPE=SUBMIT NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {
    if(isset($_POST['nom'])) {
        $user = new UtilisateurController();
        $user->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
        if (! $user->ajouterListeTache($_POST))
            echo "Nom de la liste invalide (100 caractères max et caractère '|' interdit)";
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

