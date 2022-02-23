<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 06/02/2022
 * Time: 16:09
 */
require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/LigneRechargeDAO.class.php";

function displayFormConfigE_banking(){
    try{
        foreach (LigneRechargeDAO::getLastMontantInitialEnEspece() as $item){
            $idMontant = $item['id'];
            $montant = $item['montantEnEspere'];
        }
        $tauxC = TauxDAO::getLastTaux();
        $listUsers =UtilisateurDAO::getAllRespTK();
        $listAllConfigE_banking = LigneRechargeDAO::getAllConfigE_banking($_SESSION['user']['id']);
        require "view/configE-banking.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function configE_banking($reseauE, $stockInitialEspeceCDF, $stockInitialEspeceUSD, $idRespTK, $idGerant, $montantEspece, $taux){
    try{
        LigneRechargeDAO::configE_banking($reseauE, $stockInitialEspeceCDF, $stockInitialEspeceUSD, $idRespTK, $idGerant,$montantEspece, $taux);
        displayFormConfigE_banking();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function approvE_banking($reseauE, $devise, $montantApprov, $idGerant){
    try{
        LigneRechargeDAO::approvE_banking($reseauE, $devise, $montantApprov, $idGerant);
        displayFormConfigE_banking();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function  displayTransactionE_banking(){
    try{
        $resultBD  = UtilisateurDAO::getAllClientsE_banking();
        require "view/transactionE_banking.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function cloreJour($montantClotureUSD, $montantClotureCDF, $reseauE){
    try{
        LigneRechargeDAO::cloreJour($montantClotureUSD, $montantClotureCDF, $reseauE);
        displayTransactionE_banking();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function  displayFormConfirmE_banking($idClient){
    try{
        $_SESSION['numVente'] = LigneRechargeDAO::getLastIdSaleUnit();
        $_SESSION['numVente'] = intval($_SESSION['numVente']) + 1;
        $_SESSION['numVente'] = 'FTDKS'.date("Y").date("m").date("d"). $_SESSION['numVente'];
        $listReseaux = UtilisateurDAO::getAllReseaux($idClient);
        require "view/confirmeTransactionE_banking.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function conformTransactionE_banking($idTel, $reseau, $montant, $numFact, $devise){
    try{
        LigneRechargeDAO::conformTransactionE_banking($idTel,$reseau, $montant,$_SESSION['user']['id'], $numFact, $devise);
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function saveClientE_banking($nom, $tel, $genre, $categorie, $adresse){
    try{
        $resultBD = UtilisateurDAO::getAllClients();
        $clientE_banking = new Utilisateur(0, '',$nom, $tel, $genre,
            '','Client', $categorie,'',
            '','',$adresse);
        UtilisateurDAO::saveClient($clientE_banking);
        displayTransactionE_banking();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function  displayIndexRespTK(){
    try{
        require "view/indexRespTK.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function  getAllE_bankingRespTK(){
    try{
        $reportE_banking = LigneRechargeDAO::getAllE_bankingRespTK($_SESSION['user']['id']);
        $montantInitialEspece = $reportE_banking[0]['montantEnEspere'];
        require "view/reportE_banking.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}