<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 09:44
 */

    require_once("TacheGateway.php");
    require_once("Tache.php");
    require_once ("ConnexionDB.php");

    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

    $aInserer = new Tache($description);
    $con = connexion();

    $gateway = new  TacheGateway($con);

    try {
        $gateway->insert($aInserer);
    }
    catch (Exception $e) {
        echo $e->getMessage();
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


?>