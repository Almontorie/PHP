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
    private $id;


    /**
     * ListeTache constructor.
     * @param $nom
     * @param array $listTache
     */
    public function __construct($nom, $private, $id)
    {
        $this->nom = $nom;
        $this->private = $private;
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @param array $listTache
     */
    public function setListTache($listTache)
    {
        $this->listTache = $listTache;
    }


}