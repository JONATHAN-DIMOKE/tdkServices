<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 14/01/2022
 * Time: 08:59
 */
class Produit
{
    private $id;
    private $designation;
    private $typeProduit;

    /**
     * Produit constructor.
     * @param $id
     * @param $designation
     * @param $typeProduit
     */
    public function __construct($id, $designation, $typeProduit)
    {
        $this->id = $id;
        $this->designation = $designation;
        $this->typeProduit = $typeProduit;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getTypeProduit()
    {
        return $this->typeProduit;
    }

    /**
     * @param mixed $typeProduit
     */
    public function setTypeProduit($typeProduit)
    {
        $this->typeProduit = $typeProduit;
    }



}