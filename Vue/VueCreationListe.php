<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="../style/stylesheet.css" rel="stylesheet">
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

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">To Do List</a>
        </div>
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a>
                        <?php
                            echo "Utilisateur : ".$_SESSION['pseudo'];
                        ?>
                    </a>
                </li>
                <li><button class="btn btn-default navbar-btn" onclick="window.location.href='VueAccueil.php'">Retour</button></li>
            </ul>
        </div>
    </nav>
</div>

<h1>Création d'une liste privée</h1>

<FORM METHOD="post">
    <div class="centerBloc input-group">
        <br>
        <INPUT class="form-control" TYPE=text name="nom" placeholder="Nom de la liste"> (100 caractères maximum et caractère '|' interdit)
    </div>
    <P>
        <br><INPUT type="submit" class="btn btn-success" NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {
    if(isset($_POST['nom'])) {
        $user = new UtilisateurController();
        $user->setUtilisateur(new Utilisateur($_SESSION['pseudo']));
        if (! $user->ajouterListeTache($_POST))
            echo "<p class='red-text'>Nom de la liste invalide (100 caractères max et caractère '|' interdit)</p>";
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

