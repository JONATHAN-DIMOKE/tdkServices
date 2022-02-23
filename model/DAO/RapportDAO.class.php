<?php

/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 21/01/2022
 * Time: 11:03
 */
class RapportDAO
{
    public static function getReportChange($idUser){
        try{
            $query = "CALL proc_getReport(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idUser));
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getReportReabonnement($idUser){
        try{
            $query = "CALL proc_getRepportReabonnement(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idUser));
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function getReportSaleUnite($idUser){
        try{
            $query = "CALL proc_reportVenteUnite(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idUser));
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
}