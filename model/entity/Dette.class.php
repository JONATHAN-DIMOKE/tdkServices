<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 13/01/2022
 * Time: 18:07
 */
class Dette
{
    private $id;
    private $idProduit;
    private $idClient;
    private $montant;
    private $dateDette;
    private $etatDette;
    private $idUtilisateur;
    private $note;

    /**
     * Dette constructor.
     * @param $id
     * @param $idProduit
     * @param $idClient
     * @param $montant
     * @param $dateDette
     * @param $etatDette
     * @param $idUtilisateur
     * @param $note
     */
    public function __construct($id, $idProduit, $idClient, $montant, $dateDette, $etatDette, $idUtilisateur, $note)
    {
        $this->id = $id;
        $this->idProduit = $idProduit;
        $this->idClient = $idClient;
        $this->montant = $montant;
        $this->dateDette = $dateDette;
        $this->etatDette = $etatDette;
        $this->idUtilisateur = $idUtilisateur;
        $this->note = $note;
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
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param mixed $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getDateDette()
    {
        return $this->dateDette;
    }

    /**
     * @param mixed $dateDette
     */
    public function setDateDette($dateDette)
    {
        $this->dateDette = $dateDette;
    }

    /**
     * @return mixed
     */
    public function getEtatDette()
    {
        return $this->etatDette;
    }

    /**
     * @param mixed $etatDette
     */
    public function setEtatDette($etatDette)
    {
        $this->etatDette = $etatDette;
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @param mixed $idUtilisateur
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }



}