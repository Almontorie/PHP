<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 01/12/18
 * Time: 10:36
 */

class ListeTache
{
    private $nom;
    private $listTache = [];
    private $private;

    /**
     * ListeTache constructor.
     * @param $nom
     * @param array $listTache
     */
    public function __construct($nom, array $listTache, $private)
    {
        $this->nom = $nom;
        $this->listTache = $listTache;
        $this->private = $private;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return array
     */
    public function getListTache()
    {
        return $this->listTache;
    }



}