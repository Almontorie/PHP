<link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
<link href="../style/stylesheet.css" rel="stylesheet">
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

<h1>Ajout d'une tâche publique</h1>

<FORM METHOD="post">
    <div class="centerBloc input-group">
        <br>
        <INPUT class="form-control" TYPE=text name="nom" placeholder="Nom de la tâche"> (100 caractères maximum et caractère '|' interdit)
    </div>
    <P>
        <br><INPUT type="submit" class="btn btn-success" NAME="valid" VALUE="Valider">
    </P>
</FORM>

<?php

try {
    if(isset($_POST['nom'])) {
        $user = new VisiteurController();
        $POST['nom'] = $_POST['nom'];
        if (! $user->ajouterTache($POST))
            echo "<p class='red-text'>Nom de la tâche invalide (200 caractères max et caractère '|' interdit)</p>";
        else
            header("Location: VueAccueil.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>


