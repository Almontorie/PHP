<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 24/11/18
 * Time: 10:45
 */

require_once("Controller/UtilisateurController.php");
require_once ("Gateway/ConnexionDB.php");

try {
    $user = new UtilisateurController();

    $result = $user->connexionUtilisateur(["Alexandre BOUVARD","albouvard"]);

    echo $result;

} catch (PDOException $e) {
    echo $e->getMessage();
}
