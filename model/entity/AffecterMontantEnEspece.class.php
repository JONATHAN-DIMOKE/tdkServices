<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 13/01/2022
 * Time: 17:59
 */
class AffecterMontantEnEspece
{
    private $id;
    private $idProduit;
    private $idMontant;
    private $dateAffectation;

    /**
     * AffecterMontantEnEspece constructor.
     * @param $id
     * @param $idProduit
     * @param $idMontant
     * @param $dateAffectation
     */
    public function __construct($id, $idProduit, $idMontant, $dateAffectation)
    {
        $this->id = $id;
        $this->idProduit = $idProduit;
        $this->idMontant = $idMontant;
        $this->dateAffectation = $dateAffectation;
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
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param mixed $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return mixed
     */
    public function getIdMontant()
    {
        return $this->idMontant;
    }

    /**
     * @param mixed $idMontant
     */
    public function setIdMontant($idMontant)
    {
        $this->idMontant = $idMontant;
    }

    /**
     * @return mixed
     */
    public function getDateAffectation()
    {
        return $this->dateAffectation;
    }

    /**
     * @param mixed $dateAffectation
     */
    public function setDateAffectation($dateAffectation)
    {
        $this->dateAffectation = $dateAffectation;
    }



}