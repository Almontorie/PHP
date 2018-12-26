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
    if(! empty($_POST['nom'])) {
        $user = new VisiteurController();
        $user->ajouterListeTache($_POST);
        header("Location: VueAccueil.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>