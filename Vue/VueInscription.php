<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 09/01/2019
 * Time: 20:12
 */

require_once("../Controller/UtilisateurController.php");

?>

<text>Inscription</text>
<P/>

<FORM METHOD="post">
    Pseudo : <INPUT TYPE=text name="pseudo">
    Mot de passe : <INPUT TYPE=password name="mdp">
    <P>
        <INPUT TYPE=SUBMIT NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {

    if(! empty($_POST['pseudo']) && ! empty($_POST['mdp'])) {
        $user = new UtilisateurController();
        $result = $user->inscriptionUtilisateur($_POST);
        if(!$result) {
            echo "Pseudo déjà utilisé";
        }
        else {
            header("Location: VueConnexion.php");
        }
    }

}
catch(PDOException $e){
    echo $e->getMessage();
}
?>

<button onclick="window.location.href='VueAccueil.php'">Retour</button>
