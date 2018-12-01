<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 24/11/18
 * Time: 10:45
 */

require_once ("controllerDB.php");

try {
    $pseudo = 'Mitroglou';
    $mdp = "Nul";
    //insertionUtilisateur($pseudo, $mdp);

    echo "Parcours table";
    echo "<br/>";

    $results = parcoursTableUtilisateur();
    foreach ($results as $row) {
        echo $row['pseudo'];
        echo " ";
        echo $row['mdp'];
        echo "<br/>";
    }
    echo "<br/>";


    echo "Selection ligne";
    echo "<br/>";

    $results = selectionLigne("MitroglouNUL");
    foreach ($results as $row) {
        echo $row['pseudo'];
        echo " ";
        echo $row['mdp'];
        echo "<br/>";
    }
    echo "<br/>";

    echo "Modifier ligne";
    echo "<br/>";
    $results = modifierLigne("MitroglouNUL","mdp","ttt");

    echo $results[0]['pseudo'];
    echo " ";
    echo $results[0]['mdp'];
    echo "<br/>";


} catch (PDOException $e) {
    echo $e->getMessage();
}
