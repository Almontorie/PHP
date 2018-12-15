<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 08/12/18
 * Time: 09:45
 */

require_once("../Controller/UtilisateurController.php");

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
        if(!$result) {
            echo "Connexion echouée";
        }
        else {
            echo $_POST['pseudo'];
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
                }
            }
        }
    }


} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

