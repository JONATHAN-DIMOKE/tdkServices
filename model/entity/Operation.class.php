<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 14/01/2022
 * Time: 08:56
 */
class Operation
{
    private $id;
    private $typeOperation;
    private $raison;
    private $dateOperation;
    private $idDemandeur;
    private $idGerant;

    /**
     * Operation constructor.
     * @param $id
     * @param $typeOperation
     * @param $raison
     * @param $dateOperation
     * @param $idDemandeur
     * @param $idGerant
     */
    public function __construct($id, $typeOperation, $raison, $dateOperation, $idDemandeur, $idGerant)
    {
        $this->id = $id;
        $this->typeOperation = $typeOperation;
        $this->raison = $raison;
        $this->dateOperation = $dateOperation;
        $this->idDemandeur = $idDemandeur;
        $this->idGerant = $idGerant;
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
    public function getTypeOperation()
    {
        return $this->typeOperation;
    }

    /**
     * @param mixed $typeOperation
     */
    public function setTypeOperation($typeOperation)
    {
        $this->typeOperation = $typeOperation;
    }

    /**
     * @return mixed
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * @param mixed $raison
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;
    }

    /**
     * @return mixed
     */
    public function getDateOperation()
    {
        return $this->dateOperation;
    }

    /**
     * @param mixed $dateOperation
     */
    public function setDateOperation($dateOperation)
    {
        $this->dateOperation = $dateOperation;
    }

    /**
     * @return mixed
     */
    public function getIdDemandeur()
    {
        return $this->idDemandeur;
    }

    /**
     * @param mixed $idDemandeur
     */
    public function setIdDemandeur($idDemandeur)
    {
        $this->idDemandeur = $idDemandeur;
    }

    /**
     * @return mixed
     */
    public function getIdGerant()
    {
        return $this->idGerant;
    }

    /**
     * @param mixed $idGerant
     */
    public function setIdGerant($idGerant)
    {
        $this->idGerant = $idGerant;
    }



}