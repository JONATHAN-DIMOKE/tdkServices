<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 21/01/2022
 * Time: 10:18
 */
require_once 'config/config.php';
require_once 'model/DAO/ConnectionDAO.class.php';
require_once 'model/DAO/RapportDAO.class.php';

function displayFormReport(){
    try{
        $listReports = RapportDAO::getReportChange($_SESSION['user']['id']);
        require 'view/rapport.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayFormReportReabonner(){
    try{
        $listReportsReabonnement = RapportDAO::getReportReabonnement($_SESSION['user']['id']);
        require 'view/rapportReabonner.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayFormReportSaleUnite(){
    try{
        $listReportsSaleUnite = RapportDAO::getReportSaleUnite($_SESSION['user']['id']);
        require 'view/reportSaleUnite.php';
    }catch (Exception $ex){
        errorManage($ex);
    }
}