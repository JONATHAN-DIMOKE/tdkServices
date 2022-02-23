<?php
/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 15/01/2022
 * Time: 11:03
 */
require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/DetteDAO.class.php";

function activateDeactivateDette($id, $operation){
    try{
        DetteDAO::activateDeactivateDette($id, $operation);
        require 'view/gererDette.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function displayFormGererDette(){
    try{
        $detteList = DetteDAO::getPayedDette();
        require "view/gererDette.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayFormModifierDette($idClient, $refDette){
    try{
        $detteList = DetteDAO::getDetteForClient($idClient, $refDette);
        require "view/modifierDette.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function saveDette($idClient, $montant, $reseau){
    try{
        DetteDAO::saveDette($idClient, $montant,$_SESSION['user']['id'], $reseau);
        require "view/gererDette.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function traiterDette($idProduit, $idClient, $montant, $idUtilisateur, $reseau, $refDette){
    try{
        $detteList = DetteDAO::getPayedDette();
        DetteDAO::traiterDette($idProduit, $idClient, $montant, $idUtilisateur,$reseau, $refDette);
        require "view/gererDette.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}



