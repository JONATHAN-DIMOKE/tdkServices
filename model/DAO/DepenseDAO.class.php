<?php

/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 20/02/2022
 * Time: 08:04
 */
class DepenseDAO
{
    public static function getAllDepense($idGerant){
        try{
            $req = "CALL proc_getAllDepenses(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idGerant]);
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function signalerDepense($typeDepense, $montantSortieEnCaisse, $raison, $nomDemandeur, $idGerant){
        try{
            $query = "CALL proc_signalerDepense(?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($typeDepense, $montantSortieEnCaisse, $raison, $nomDemandeur, $idGerant));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function epurerDepense($idDepense){
        try{
            $query = "CALL proc_signalerPayeDepense(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idDepense));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
}