<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 13/01/2022
 * Time: 18:04
 */
class DetailPrixProduit
{
    private $id;
    private $idProduit;
    private $idPrix;
    private $prixUnitaire;
    private $dateCreation;
    private $dateDesactivation;
    private $idGerant;

    /**
     * DetailPrixProduit constructor.
     * @param $id
     * @param $idProduit
     * @param $idPrix
     * @param $prixUnitaire
     * @param $dateCreation
     * @param $dateDesactivation
     * @param $idGerant
     */
    public function __construct($id, $idProduit, $idPrix, $prixUnitaire, $dateCreation, $dateDesactivation, $idGerant)
    {
        $this->id = $id;
        $this->idProduit = $idProduit;
        $this->idPrix = $idPrix;
        $this->prixUnitaire = $prixUnitaire;
        $this->dateCreation = $dateCreation;
        $this->dateDesactivation = $dateDesactivation;
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
    public function getIdPrix()
    {
        return $this->idPrix;
    }

    /**
     * @param mixed $idPrix
     */
    public function setIdPrix($idPrix)
    {
        $this->idPrix = $idPrix;
    }

    /**
     * @return mixed
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    /**
     * @param mixed $prixUnitaire
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getDateDesactivation()
    {
        return $this->dateDesactivation;
    }

    /**
     * @param mixed $dateDesactivation
     */
    public function setDateDesactivation($dateDesactivation)
    {
        $this->dateDesactivation = $dateDesactivation;
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