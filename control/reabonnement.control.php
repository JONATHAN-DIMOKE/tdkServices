<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 13/01/2022
 * Time: 15:22
 */
require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/ReabonnerDAO.class.php";


function displayFormReabonnement(){
    try{
        $resultBD = UtilisateurDAO::getAllClientsReabonne();
        require "view/reabonnerClient.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function affectCodeDecodeur($idClient, $idUser, $codeDecodeur, $denomination){
    try{
        $resultBD = UtilisateurDAO::getAllClients();
        ReabonnerDAO::affectDecodeur($idClient, $idUser, $codeDecodeur, $denomination);
        require "view/reabonnerClient.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function getAllDenomination($idClient){
    try{
        $listCodeDecodeur  = ReabonnerDAO::getAllDenomination($idClient);
        require 'view/confirmReabonnement.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function confirmerReabonnement($idRespCUR,$denomination, $idDecodeur, $montant, $operation){
    try{
        ReabonnerDAO::confirmerReabonnement($idRespCUR,$denomination, $idDecodeur, $montant, $operation);
        //require 'view/confirmReabonnement.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function displayFormConfigReabonnement(){
    try{
        $listUsers = UtilisateurDAO::getAllUsers();
        $listBalanceConfig = ReabonnerDAO::getAllBalancesReabonnementConfig($_SESSION['user']['id']);
        require "view/configReabonner.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function configReabonnement($idRespCUR, $denomination, $balanceR, $newBalanceR, $idGerant){
    try{
        $listUsers = UtilisateurDAO::getAllUsers();
        $listBalanceConfig = ReabonnerDAO::getAllBalancesReabonnementConfig($idGerant);
        ReabonnerDAO::configReabonnement($idRespCUR, $denomination, $balanceR, $newBalanceR, $idGerant);
        require "view/configReabonner.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function approvCompteReabonnement($denomination, $qteApprov){
    try{
        $listUsers = UtilisateurDAO::getAllUsers();
        $listBalanceConfig = ReabonnerDAO::getAllBalancesReabonnementConfig($_SESSION['user']['id']);
        ReabonnerDAO::approvCompteReabonnement($denomination, $qteApprov);
        require "view/configReabonner.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function archiverBalanceReabonne($idLigneRecharge){
    try{
        $listUsers = UtilisateurDAO::getAllUsers();
        $listBalanceConfig = ReabonnerDAO::getAllBalancesReabonnementConfig($_SESSION['user']['id']);
        ReabonnerDAO::archverBalanceReabonnement($idLigneRecharge);
        require "view/configReabonner.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function consultHistoriquesReabonnement(){
    try{
        $compteur = 1;
        $listHistoryReabonnement = ReabonnerDAO::consultHistoriquesReabonnement();
        require "view/historiquesReabonnements.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

