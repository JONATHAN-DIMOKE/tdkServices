<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 13/01/2022
 * Time: 15:21
 */

require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/UtilisateurDAO.class.php";
require_once "model/DAO/LigneRechargeDAO.class.php";
require_once "partial/errorManage.view.php";

function displayFormVendreUnite(){
    try{
        $lastId = LigneRechargeDAO::getLastIdSaleUnit();
        $resultBD = UtilisateurDAO::getAllClients();
        require "view/vendreUnite.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayFormConfirmerVenteUnite($idClient){
    try{
        $_SESSION['numVente'] = LigneRechargeDAO::getLastIdSaleUnit();
        $_SESSION['numVente'] = intval($_SESSION['numVente']) + 1;
        $_SESSION['numVente'] = 'FTDKS'.date("Y").date("m").date("d"). $_SESSION['numVente'];
        getAllReseaux($idClient);
        //require "view/confirmerVenteUnite.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function confirmerVenteUnite($idTel, $reseau, $montant, $numFact){
    try{
        LigneRechargeDAO::vendreUnites($idTel,$reseau, $montant,$_SESSION['user']['id'], $numFact);
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function updateStatePrint($refVente){
    try{
        LigneRechargeDAO::updateStatePrint($refVente);
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function configBalanceVenteUnite($idUtilisateur, $reseauU, $balanceU, $newBalanceU){
    try{
        $listAllConfigVenteUnite = LigneRechargeDAO::getAllConfigVenteUnite();
        LigneRechargeDAO::configVenteUnite($idUtilisateur, $reseauU, $balanceU, $newBalanceU);
        require 'view/configVenteUnite.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function approvCompteUnite($reseauU, $qteApprov){
    try{
        $listAllConfigVenteUnite = LigneRechargeDAO::getAllConfigVenteUnite();
        LigneRechargeDAO::approvCompteUnite($reseauU, $qteApprov);
        require 'view/configVenteUnite.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function printInvoice($idRespCUR){
    try{
        $dataInvoice = LigneRechargeDAO::getInvoice($idRespCUR);
        require 'view/facture.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function displayListInvoicesNotPrint(){
    try{
        $compteur = 1;
        $listInvoicesNotPrinted = LigneRechargeDAO::getAllSalesUniteNotPrint();
        require 'view/listInvoicesNotPrint.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function consultHistoriquesSalesUnite(){
    try{
        $compteur = 1;
        $listHistorySalesUnite = LigneRechargeDAO::getHistoryOfSalesUnite();
        require 'view/historiquesSalesUnites.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function configMontantInitialEspece(){
    try{
        $compteur = 1;
        $listAllAmountAffect = LigneRechargeDAO::getAllMontantAffect($_SESSION['user']['id']);
        $listAllUsers = UtilisateurDAO::getAllUsers();
        require 'view/affecterMontantInitial.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function affectMontantInitial($montantIntial, $idGerant, $raison, $idRespCUR){
    try{
        LigneRechargeDAO::affectMontantInitialeEnEspece($montantIntial, $idGerant, $raison, $idRespCUR);
        configMontantInitialEspece($_SESSION['user']['id']);
    }catch (Exception $ex){
        errorManage($ex);
    }
}


