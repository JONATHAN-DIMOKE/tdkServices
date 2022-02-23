<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 13/01/2022
 * Time: 15:22
 */
require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/LigneRechargeDAO.class.php";

function displaySaleKitTV(){
    try{
        require "view/saleKitTV.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function configKitTV($denominationK, $stockInitialK, $puK, $idRespTK, $idGerant){
    try{
        LigneRechargeDAO::configKitTV($denominationK, $stockInitialK, $puK, $idRespTK, $idGerant);
        displayConfigKit();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function  displayConfigKit(){
    try{
        $listAllKitTV = LigneRechargeDAO::getAllKit($_SESSION['user']['id']);
        $listUsers =UtilisateurDAO::getAllRespTK();
        require "view/configKitTV.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function approvKitTV($denominationK, $approvK){
    try{
        LigneRechargeDAO::approvKitTV($denominationK, $approvK);
        displayConfigKit();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function confirmSaleKitTV($denominationK, $venteK, $idRespTK, $idClient){
    try{
        LigneRechargeDAO::confirmSaleKitTV($denominationK, $venteK, $idRespTK, $idClient);
        displaySaleKitTVRespKT();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displaySaleKitTVRespKT(){
    try{
        $listClient = UtilisateurDAO::getAllClients();
        require "view/saleKitTVRespKT.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayCreateCommission(){
    try{
        $listCommissionDuJour = LigneRechargeDAO::getAllCommission($_SESSION['user']['id']);
        require "view/createCommission.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function reportCommission(){
    try{
        $listCommissionDuJour = LigneRechargeDAO::getAllCommission($_SESSION['user']['id']);
        require "view/reportCommission.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function reportKitTV(){
    try{
        $reportKitTV = LigneRechargeDAO::getAllKitRespTK($_SESSION['user']['id']);
        require "view/reportKitTV.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function confirmCommission($reseauCOM, $commissionInitialeCDF, $commissionInitialeUSD, $commissionFinaleCDF, $commissionFinaleUSD, $beneficeCDF, $beneficeUSD, $idRespTK){
    try{
        LigneRechargeDAO::confirmCommission($reseauCOM, $commissionInitialeCDF, $commissionInitialeUSD, $commissionFinaleCDF, $commissionFinaleUSD, $beneficeCDF, $beneficeUSD, $idRespTK);
        displayCreateCommission();
    }catch (Exception $ex){
        errorManage($ex);
    }
}