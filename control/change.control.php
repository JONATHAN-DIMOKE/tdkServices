<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 13/01/2022
 * Time: 15:23
 */
require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/UtilisateurDAO.class.php";
require_once "model/DAO/LigneRechargeDAO.class.php";
require_once "model/DAO/TauxDAO.class.php";
require_once "model/DAO/ChangeDAO.class.php";
require_once "partial/errorManage.view.php";

function displayFormChangeDollard(){
    try{
        $changeList = LigneRechargeDAO::getHistoriqueChange();
        $valeurTaux = TauxDAO::getLastTaux();
        require "view/changeDollard.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function saveCapitalChange($idRespCUR,$capitalC,$idDateRecharge, $changeC, $tauxC, $resteC){
    try{
        $valeurTaux = TauxDAO::getLastTaux();
        $changeList = LigneRechargeDAO::getHistoriqueChange();
        LigneRechargeDAO::saveCapitalChange($capitalC, $idDateRecharge, $changeC, $tauxC, $resteC, $idRespCUR);
        require "view/changeDollard.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function saveHistoriqueChange($idRespCUR, $montantUSD, $montantCDF){
    try{
        $valeurTaux = TauxDAO::getLastTaux();
        $changeList = LigneRechargeDAO::getHistoriqueChange();
        echo ChangeDAO::saveHistorique($idRespCUR, $montantUSD, $montantCDF);
        //require "view/changeDollard.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function consultHistoriquesChange(){
    try{
        $listHistoryChange = ChangeDAO::getAllHistoriquesChanges();
        require "view/historiquesChange.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function resetTableu(){
    try{
        $valeurTaux = TauxDAO::getLastTaux();
        $changeList = LigneRechargeDAO::getHistoriqueChange();
        require 'view/tableauReset.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}
