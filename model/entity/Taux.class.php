<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 14/01/2022
 * Time: 09:01
 */
class Taux
{
    private $id;
    private $montant;
    private $dateCreation;
    private $dateTauxJour;
    private $idUtilisateur;

    /**
     * Taux constructor.
     * @param $id
     * @param $montant
     * @param $dateCreation
     * @param $dateTauxJour
     * @param $idUtilisateur
     */
    public function __construct($id, $montant, $dateCreation, $dateTauxJour, $idUtilisateur)
    {
        $this->id = $id;
        $this->montant = $montant;
        $this->dateCreation = $dateCreation;
        $this->dateTauxJour = $dateTauxJour;
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
    public function getDateTauxJour()
    {
        return $this->dateTauxJour;
    }

    /**
     * @param mixed $dateTauxJour
     */
    public function setDateTauxJour($dateTauxJour)
    {
        $this->dateTauxJour = $dateTauxJour;
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