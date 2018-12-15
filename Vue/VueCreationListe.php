<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 09:30
 */

require_once ("../Controller/UtilisateurController.php");

session_start();

?>

<FORM METHOD="post">
    Nom de la liste : <INPUT TYPE=text name="nom">
    <P>
        <INPUT TYPE=SUBMIT NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {
    if(! empty($_POST['nom'])) {
        $user = new UtilisateurController();
        $user->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
        $user->ajouterListeTache($_POST);
        header("Location: VueListeTache.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>