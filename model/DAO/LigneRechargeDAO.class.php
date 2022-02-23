<?php

/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 15/01/2022
 * Time: 10:50
 */
class LigneRechargeDAO
{
    public static function vendreUnites($idTel, $reseau, $montant, $idUtilisateur, $numVente){
        try{
                $query = "CALL proc_confirmVente(?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $idTel, $reseau, $montant, $idUtilisateur, 'Unite', $numVente
            ));
            return $queryPrepare;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function conformTransactionE_banking($idTel, $reseau, $montant, $idUtilisateur, $transRef, $devise){
        try{
            $query = "CALL proc_confirmTransactionE_banking(?, ?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $idTel, $reseau, $montant, $idUtilisateur, 'E-banking', $transRef, $devise
            ));
            return $queryPrepare;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function configKitTV($denominationK, $stockInitialK, $puK, $idRespTK, $idGerant){
        try{
            $query = "CALL proc_configKit_TV(?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $denominationK, $stockInitialK, $puK, $idRespTK, $idGerant
            ));
            return $queryPrepare;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function cloreJour($montantClotureUSD, $montantClotureCDF, $reseauE){
        try{
            $query = "CALL proc_cloreJour(?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $montantClotureUSD, $montantClotureCDF, $reseauE
            ));
            return $queryPrepare;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function configVenteUnite($idUtilisateur, $reseauU, $balanceU, $newBalanceU){
        try{
            $query = "CALL proc_configSaleUnite(?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $idUtilisateur, $reseauU, $balanceU, $newBalanceU
            ));
            return $queryPrepare;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function saveCapitalChange($capitalC,$idDateRecharge, $changeC, $tauxC, $resteC, $idRespCUR){
        try{
            $query = "CALL proc_saveCapitalChange(?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($capitalC,$idDateRecharge, $changeC, $tauxC, $resteC, $idRespCUR));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function configE_banking($reseauE, $stockInitialEspeceCDF, $stockInitialEspeceUSD, $idRespTK, $idGerant, $montantEspece, $taux){
        try{
            $query = "CALL proc_configE_banking(?, ?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($reseauE, $stockInitialEspeceCDF, $stockInitialEspeceUSD, $idRespTK, $idGerant, $montantEspece, $taux));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function affectMontantInitialeEnEspece($montantIntial, $idGerant, $raison, $idRespCUR){
        try{
            $query = "CALL proc_affectMontantEnEspece(?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($montantIntial, $idGerant, $raison, $idRespCUR));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function approvCompteUnite($reseauU, $qteApprov){
        try{
            $query = "CALL proc_approvCompte(?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($reseauU, $qteApprov));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function confirmCommission($reseauCOM, $commissionInitialeCDF, $commissionInitialeUSD, $commissionFinaleCDF, $commissionFinaleUSD, $beneficeCDF, $beneficeUSD, $idRespTK){
        try{
            $query = "CALL proc_confirmCommission(?, ?, ?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($reseauCOM, $commissionInitialeCDF, $commissionInitialeUSD, $commissionFinaleCDF, $commissionFinaleUSD, $beneficeCDF, $beneficeUSD, $idRespTK));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function confirmSaleKitTV($denominationK, $venteK, $idRespTK, $idClient){
        try{
            $query = "CALL proc_confirmSaleKitTV(?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($denominationK, $venteK, $idRespTK, $idClient));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function approvKitTV($denominationK, $qteApprov){
        try{
            $query = "CALL proc_approvKitTV(?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($denominationK, $qteApprov));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function approvE_banking ($reseauE, $devise, $montantApprov, $idGerant){
        try{
            $query = "CALL proc_approvE_banking (?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($reseauE, $devise, $montantApprov, $idGerant));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function updateStatePrint($numSaleUnite){
        try{
            $query = "CALL proc_updateStatePrint(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($numSaleUnite));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getHistoriqueChange(){
        try{
            $req = "call proc_getHistoriqueChange()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function getAllConfigVenteUnite(){
        try{
            $req = "call proc_getAllBalanceUnite()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getInvoice($idRespCUR){
        try{
            $req = "CALL proc_getInvoiceSaleUnite(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idRespCUR]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getLastIdSaleUnit(){
        try{
            $req = "CALL proc_getLastIdSaleUnite()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchColumn();
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getLastMontantInitialEnEspece(){
        try{
            $req = "CALL proc_getLastMontantInitialEnEspece()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllSalesUniteNotPrint(){
        try{
            $req = "CALL proc_getAllSalesUniteNotPrint()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getHistoryOfSalesUnite(){
        try{
            $req = "CALL proc_getHistoryOfSalesUnite()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllMontantAffect($idGerant){
        try{
            $req = "CALL proc_getAllMontantAffect(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idGerant]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllConfigE_banking($idGerant){
        try{
            $req = "CALL proc_getAllConfigE_banking(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idGerant]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllKit($idGerant){
        try{
            $req = "CALL proc_getAllKit(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idGerant]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllCommission($idRespTK){
        try{
            $req = "CALL proc_getAllCommission(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idRespTK]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllKitRespTK($idRespTK){
        try{
            $req = "CALL proc_getAllKitRespTK(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idRespTK]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllE_bankingRespTK($idRespTK){
        try{
            $req = "CALL proc_getAllE_banking(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idRespTK]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }


}