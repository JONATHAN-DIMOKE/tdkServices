<?php

/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 17/01/2022
 * Time: 12:31
 */
class ReabonnerDAO
{
    public static function affectDecodeur($idClient, $idUtilisateur, $codeDecodeur, $denomination){
        try{
            $query = "CALL proc_affectCodeDecodeur(?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idClient, $idUtilisateur, $codeDecodeur, $denomination));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }


    public static function getAllDenomination($idClient){
        try{
            $query = "CALL proc_getAllDenomination(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idClient));
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllBalancesReabonnementConfig($idGerant){
        try{
            $query = "CALL proc_getAllBalanceReabonne(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idGerant));
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function consultHistoriquesReabonnement(){
        try{
            $query = "CALL proc_getHistoryReabonnement()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function confirmerReabonnement($idRespCUR,$denomination, $idDecodeur, $montant, $operation){
        try{
            $query = "CALL proc_confirmReabonnement(?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idRespCUR, $idDecodeur, $montant, $operation, $denomination));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function configReabonnement($idRespCUR,$denomination, $balanceR, $newBalanceR, $idGerant){
        try{
            $query = "CALL proc_configReannement(?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idRespCUR,$denomination, $balanceR, $newBalanceR, $idGerant));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function approvCompteReabonnement($denomination, $qteApprov){
        try{
            $query = "CALL proc_approvCompteReabonnement(?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($denomination, $qteApprov));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function archverBalanceReabonnement($idLigneRecharge){
        try{
            $query = "CALL proc_archiverArtivite(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idLigneRecharge));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
}