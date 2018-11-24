<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 24/11/18
 * Time: 10:45
 */

require_once ("controllerDB.php");

try{
    start();
}
catch (PDOException $e){
    echo $e->getMessage();
}
