<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 15/12/18
 * Time: 10:48
 */

require_once ("../Controller/VisiteurController.php");

$user = new VisiteurController();
$tab = $user->chargementTabListTache();

foreach ($tab as $item) {
    echo $item->getNom();
    echo "<br/>";
}

?>