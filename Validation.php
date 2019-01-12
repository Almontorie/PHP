<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 27/12/2018
 * Time: 12:13
 */

class Validation
{

    private $taskLength = 200;
    private $listLength = 100;

    function validInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validTaskLength($task){
        if(strlen($task) > $this->taskLength or empty($task) or stripos($task, '|'))
            return false;
        return true;
    }

    function validListLength($list){
        if(strlen($list) > $this->listLength or empty($list) or stripos($list, '|'))
            return false;
        return true;
    }

}