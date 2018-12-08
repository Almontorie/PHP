<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 08/12/18
 * Time: 09:45
 */

require_once("../Controller/UtilisateurController.php");
$_POST['pseudo'] = "";
$_POST['mdp'] = "";

?>


<FORM METHOD="post">
    Pseudo : <INPUT TYPE=text name="pseudo">
    Mot de passe : <INPUT TYPE=text name="mdp">
    <P>
        <INPUT TYPE=SUBMIT NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {
    if(! empty($_POST['pseudo']) && ! empty($_POST['mdp'])) {
        $user = new UtilisateurController();
        $result = $user->connexionUtilisateur($_POST);
        echo $result;
    }


} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

