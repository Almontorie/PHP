<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="../style/stylesheet.css" rel="stylesheet">
<link href="../bootstrap-3.3.7-dist/css/sticky-footer.css" rel="stylesheet">
<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 26/12/2018
 * Time: 20:11
 */

require_once ("../Controller/FrontController.php");

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

<h1>Création d'une liste publique</h1>

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
    $action = "";

    if(isset($_POST['nom'])) {
        $action = "creationListePubliqueNom";
    }

    $front = new FrontController($action);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Designed by Lucas Torret et Alexis Montorier</p>
    </div>
</footer>

