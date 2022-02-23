<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 13/01/2022
 * Time: 18:02
 */
class DateRecharge
{
    private $id;
    private $jour;
    private $mois;
    private $annee;
    private $heure;

    /**
     * DateRecharge constructor.
     * @param $id
     * @param $jour
     * @param $mois
     * @param $annee
     * @param $heure
     */
    public function __construct($id, $jour, $mois, $annee, $heure)
    {
        $this->id = $id;
        $this->jour = $jour;
        $this->mois = $mois;
        $this->annee = $annee;
        $this->heure = $heure;
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
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     * @return mixed
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * @param mixed $mois
     */
    public function setMois($mois)
    {
        $this->mois = $mois;
    }

    /**
     * @return mixed
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param mixed $annee
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }



}