<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 18/01/2022
 * Time: 17:12
 */
class ChangeDAO
{
    public static function saveHistorique($idRespCUR, $montantUSD, $montantCDF){
        try{
            $query = "call proc_saveHistoriqueChange(?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idRespCUR, $montantUSD, $montantCDF));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function getAllHistoriquesChanges(){
        try{
            $req = "CALL proc_getAllHistoriques()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
}