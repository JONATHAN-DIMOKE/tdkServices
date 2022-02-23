<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 15/01/2022
 * Time: 10:54
 */
require_once "partial/errorManage.view.php";
class DetteDAO
{
    public static function getPayedDette(){
        try{
            $req = "call proc_getPayeDette()";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute();
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function activateDeactivateDette($id, $operation){
        try{
            $req = "call proc_AcitvateDeactivateDette(?,?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute(array($id, $operation));
            $req_prepare->closeCursor();

        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getDetteForClient($idClient, $refDette){
        try{
            echo $idClient;
            echo $refDette;
            $req = "CALL proc_getDettePourClient(?, ?)";
            $req_prepare = ConnectionDAO::getConnexion()->prepare($req);
            $req_prepare->execute(array($idClient, $refDette));
            $result = $req_prepare->fetchAll(PDO::FETCH_ASSOC);
            $req_prepare->closeCursor();
            return $result;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function saveDette($idClient,$montant, $idUtilisateur, $reseau){
        try{
            $query = "CALL proc_saveSaleToDette(?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $idClient, $montant, $idUtilisateur, $reseau));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function traiterDette($idProduit, $idClient,$montant, $idUtilisateur, $reseau, $refDette){
        try{
            $query = "CALL proc_treatDette(?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $idProduit, $idClient,$montant, $idUtilisateur, $reseau, $refDette
            ));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

}