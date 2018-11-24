<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 24/11/18
 * Time: 10:10
 */

require_once('ConnexionDB.php');


function start()
{
    try {
        $pseudo = 'Mitroglou';
        $mdp = "Nul";
        insertionUtilisateur($pseudo, $mdp);

        parcoursTableUtilisateur();
    } catch (PDOException $e) {
        throw $e;
    }
}


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
        $con->executeQuery($query,NULL);
    }
    catch (PDOException $e){
        throw $e;
    }
}