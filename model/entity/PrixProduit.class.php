<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 14/01/2022
 * Time: 08:58
 */
class PrixProduit
{
    private $id;
    private $devise;
    private $dateCreation;
    private $idUtilisateur;

    /**
     * PrixProduit constructor.
     * @param $id
     * @param $devise
     * @param $dateCreation
     * @param $idUtilisateur
     */
    public function __construct($id, $devise, $dateCreation, $idUtilisateur)
    {
        $this->id = $id;
        $this->devise = $devise;
        $this->dateCreation = $dateCreation;
        $this->idUtilisateur = $idUtilisateur;
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


}