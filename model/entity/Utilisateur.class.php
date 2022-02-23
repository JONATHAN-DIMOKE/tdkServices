<?php

/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 12/01/2022
 * Time: 14:59
 */
class Utilisateur
{
    private $id;
    private $codeAgent;
    private $nom;
    private $tel;
    private $genre;
    private $etatCivil;
    private $typeUser;
    private $categorie;
    private $statut;
    private $etatConnection;
    private $pwd;
    private $adresse;

    /**
     * Utilisateur constructor.
     * @param $id
     * @param $codeAgent
     * @param $nom
     * @param $tel
     * @param $genre
     * @param $etatCivil
     * @param $typeUser
     * @param $categorie
     * @param $statut
     * @param $etatConnection
     * @param $pwd
     * @param $adresse
     */
    public function __construct($id, $codeAgent, $nom, $tel, $genre, $etatCivil, $typeUser, $categorie, $statut, $etatConnection, $pwd, $adresse)
    {
        $this->id = $id;
        $this->codeAgent = $codeAgent;
        $this->nom = $nom;
        $this->tel = $tel;
        $this->genre = $genre;
        $this->etatCivil = $etatCivil;
        $this->typeUser = $typeUser;
        $this->categorie = $categorie;
        $this->statut = $statut;
        $this->etatConnection = $etatConnection;
        $this->pwd = $pwd;
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
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
    public function getCodeAgent()
    {
        return $this->codeAgent;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return mixed
     */
    public function getEtatCivil()
    {
        return $this->etatCivil;
    }

    /**
     * @return mixed
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @return mixed
     */
    public function getEtatConnection()
    {
        return $this->etatConnection;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }
}