<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 26/12/2018
 * Time: 20:11
 */

require_once ("../Controller/VisiteurController.php");

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
        $user = new VisiteurController();
        if (! $user->ajouterListeTache($_POST))
            echo "Nom de la liste invalide (100 caractères max)";
        else
            header("Location: VueAccueil.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<button onclick="window.location.href='VueAccueil.php'">Retour</button>

