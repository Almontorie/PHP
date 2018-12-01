<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 24/11/18
 * Time: 10:10
 */

require_once('ConnexionDB.php');




function connexion() {
    try {
        $dsn = "mysql:host=localhost;dbname=dbalmontorie";
        $user = "almontorie";
        $passwd = "nulmitroglou";
        return new ConnexionDB($dsn, $user, $passwd);
    }
    catch (PDOException $e){
        throw $e;
    }
}

function insertionUtilisateur($pseudo, $mdp)
{
    try {
    $con = connexion();
    $query = 'INSERT into Utilisateur values(:pseudo,:mdp)';
    $con->executeQuery($query, array(
        ':pseudo' => array($pseudo, PDO::PARAM_STR),
        ':mdp' => array($mdp, PDO::PARAM_STR)));
    }
    catch (PDOException $e) {
        throw $e;
    }
}

function parcoursTableUtilisateur()
{
    try {
        $con = connexion();
        $query = 'SELECT * FROM Utilisateur';
        $con->executeQuery($query);
        return $con->getResults();
    }
    catch (PDOException $e){
        throw $e;
    }
}

function selectionLigne($pseudo)
{
    try {
        $con = connexion();
        $query = 'SELECT * FROM Utilisateur WHERE pseudo = :pseudo';

        $con->executeQuery($query, array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR)
        ));
        return $con->getResults();
    }
    catch (PDOException $e){
        throw $e;
    }
}


//affiche la ligne modifiée
function modifierLigne($pseudo, $modif, $champ){
    try {
        $con = connexion();
        if ($modif == "pseudo")
            $query = 'UPDATE Utilisateur SET pseudo = :modif WHERE pseudo = :pseudo ';
        elseif ($modif == "mdp")
            $query = 'UPDATE Utilisateur SET mdp = :modif WHERE pseudo = :pseudo ';

        $con->executeQuery($query, array(
            ':modif' => array($champ, PDO::PARAM_STR),
            ':pseudo' => array($pseudo, PDO::PARAM_STR)
        ));

        return selectionLigne($pseudo);
    }
    catch (PDOException $e){
        throw $e;
    }
}