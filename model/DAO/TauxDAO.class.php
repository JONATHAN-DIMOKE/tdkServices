<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 17/01/2022
 * Time: 12:02
 */
class TauxDAO
{
    public static function getLastTaux(){
        try{
            $req = "call proc_getLastTaux";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchColumn();
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllTaux($idGerant){
        try{
            $req = "CALL proc_getAllTaux(?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$idGerant]);
            $result = $req_prepare->fetchAll();
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function configTauxDuJour($montantTaux, $dateJour, $idGerant){
        try{
            $req = "CALL proc_configTaux(?, ?, ?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute([$montantTaux, $dateJour, $idGerant]);
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
}