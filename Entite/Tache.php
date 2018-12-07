<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 08:45
 */

class Tache
{

    private $nom;
    private $complete;

    /**
     * Tache constructor.
     * @param $nom
     */
    public function __construct($nom)
    {
        $this->nom = $nom;
        $this->complete = false;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return bool
     */
    public function isComplete()
    {
        return $this->complete;
    }

    /**
     * @param bool $complete
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;
    }
}