<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 14/01/2022
 * Time: 08:54
 */
class MontantEspece
{
    private $id;
    private $montantEnEspece;
    private $dateCreation;
    private $idUtilisateur;
    private $devise;
    private $raison;

    /**
     * MontantEspece constructor.
     * @param $id
     * @param $montantEnEspece
     * @param $dateCreation
     * @param $idUtilisateur
     * @param $devise
     * @param $raison
     */
    public function __construct($id, $montantEnEspece, $dateCreation, $idUtilisateur, $devise, $raison)
    {
        $this->id = $id;
        $this->montantEnEspece = $montantEnEspece;
        $this->dateCreation = $dateCreation;
        $this->idUtilisateur = $idUtilisateur;
        $this->devise = $devise;
        $this->raison = $raison;
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
    public function getMontantEnEspece()
    {
        return $this->montantEnEspece;
    }

    /**
     * @param mixed $montantEnEspece
     */
    public function setMontantEnEspece($montantEnEspece)
    {
        $this->montantEnEspece = $montantEnEspece;
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
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * @param mixed $devise
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;
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


}