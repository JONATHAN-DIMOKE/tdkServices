<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 20/02/2022
 * Time: 07:48
 */
require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/DepenseDAO.class.php";

function  displaySignalerDepenses(){
    try{
        $listDepenses = DepenseDAO::getAllDepense($_SESSION['user']['id']);
        require "view/signalerDepenses.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function  creerDepense($typeDepense, $montantSortieEnCaisse, $raison, $nomDemandeur, $idGerant){
    try{
        DepenseDAO::signalerDepense($typeDepense, $montantSortieEnCaisse, $raison, $nomDemandeur, $idGerant);
        displaySignalerDepenses();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function  epurerDepense($idDepense){
    try{
        DepenseDAO::epurerDepense($idDepense);
        displaySignalerDepenses();
    }catch (Exception $ex){
        errorManage($ex);
    }
}