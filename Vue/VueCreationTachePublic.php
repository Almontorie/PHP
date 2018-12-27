<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 27/12/2018
 * Time: 21:40
 */

require_once ("../Controller/VisiteurController.php");

session_start();

$POST['id'] = $_SESSION['id'];
?>

    <FORM METHOD="post">
        Nom de la tâche : <INPUT TYPE=text name="nom">
        <P>
            <INPUT TYPE=SUBMIT NAME="valid" VALUE="Valider">
        </P>
    </FORM>

<?php

try {
    if(isset($_POST['nom'])) {
        $user = new VisiteurController();
        $POST['nom'] = $_POST['nom'];
        if (! $user->ajouterTache($POST))
            echo "Nom de la liste invalide (200 caractères max)";
        else
            header("Location: VueAccueil.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>