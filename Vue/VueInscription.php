<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="../style/stylesheet.css" rel="stylesheet">
<link href="../bootstrap-3.3.7-dist/css/sticky-footer.css" rel="stylesheet">
<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 09/01/2019
 * Time: 20:12
 */

require_once("../Controller/UtilisateurController.php");

?>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">To Do List</a>
        </div>
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
                <li><button class="btn btn-default navbar-btn" onclick="window.location.href='VueAccueil.php'">Retour</button></li>
            </ul>
        </div>
    </nav>
</div>

<h1>Inscription</h1>

<FORM METHOD="post">
    <div class="centerBloc input-group">
        <br>
        <INPUT class="form-control" TYPE=text name="pseudo" placeholder="Pseudo">
        <br><br>
        <INPUT class="form-control" TYPE=password name="mdp" placeholder="Mot de passe">
        <br><br>
    </div>
    <P>
        <br><INPUT type="submit" class="btn btn-success" NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {

    if(! empty($_POST['pseudo']) && ! empty($_POST['mdp'])) {
        $user = new UtilisateurController();
        $result = $user->inscriptionUtilisateur($_POST);
        if(!$result) {
            echo "<p class='red-text'>Pseudo déjà utilisé</p>";
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
<footer class="footer">
    <div class="container">
        <p class="text-muted">Designed by Lucas Torret et Alexis Montorier</p>
    </div>
</footer>