<?php

/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 12/01/2022
 * Time: 15:30
 */
class UtilisateurDAO
{
    public static function connectUser($codeAgent, $pwd){
        try{
            $query = "CALL proc_connectUser(?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($codeAgent, $pwd));
            $resultDB = $queryPrepare->fetch(PDO::FETCH_ASSOC);
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function saveClient(Utilisateur $utilisateur){
        try{
            $query = "CALL proc_saveClient(?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($utilisateur->getNom(),
                                        $utilisateur->getTel(),
                                        $utilisateur->getGenre(),
                                        $utilisateur->getCategorie(),
                                        $utilisateur->getAdresse()));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllClients(){
        try{
            $query = "CALL proc_getAllClient()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllClientsE_banking(){
        try{
            $query = "CALL proc_getAllClientE_banking()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllClientsReabonne(){
        try{
            $query = "CALL proc_getClientReabonne()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function affectPhone($idClient, $idUtilisateur, $tel, $reseau){
        try{
            $query = "CALL proc_affectPhone(?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $idClient, $idUtilisateur, $tel, $reseau
            ));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function reconfigureAccount($idUtilisateur, $nom, $tel, $adresse, $etatCivil, $genre){
        try{
            $query = "CALL proc_reconfigurerCompte(?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $idUtilisateur, $nom, $tel, $adresse, $etatCivil, $genre
            ));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllReseaux($idClient){
        try{
            $query = "CALL proc_getAllReseaux(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($idClient));
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function forgotPwd($newPwd, $codeAgent){
        try{
            $query = "CALL proc_updatePwd(?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array($newPwd, $codeAgent));
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function updateStatusUserAccount($idUser){
        try{
            $query = "CALL proc_updateUserAccount(?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute([$idUser]);
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function createUser(Utilisateur $utilisateur){
        try{
            $query = "CALL proc_createUser(?, ?, ?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute(array(
                $utilisateur->getNom(),
                $utilisateur->getTel(),
                $utilisateur->getGenre(),
                $utilisateur->getTypeUser(),
                $utilisateur->getAdresse(),
                $utilisateur->getEtatCivil()
            ));
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function getAllUsers(){
        try{
            $query = "CALL proc_getAllUser()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllDateRecharge(){
        try{
            $query = "CALL proc_getAllDateRecharge()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
            $resultDB = $queryPrepare->fetchAll();
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function getAllRespTK(){
        try{
            $query = "CALL getAllRespTK()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
            $resultDB = $queryPrepare->fetchAll(PDO::FETCH_ASSOC);
            $queryPrepare->closeCursor();
            return $resultDB;
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
    public static function createFirstUser(){
        try{
            $query = "CALL proc_createFirstUser()";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute();
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function configDateRecharge($jour, $mois, $annee, $heure){
        try{
            $query = "CALL proc_configDateRecharge(?, ?, ?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute([$jour, $mois, $annee, $heure]);
        }catch (Exception $ex){
            errorManage($ex);
        }
    }

    public static function updateConnectionState($codeAgent, $pwd){
        try{
            $query = "CALL proc_updateConnectionState(?, ?)";
            $queryPrepare = ConnectionDAO::getConnexion()->prepare($query);
            $queryPrepare->execute([$codeAgent, $pwd]);
        }catch (Exception $ex){
            errorManage($ex);
        }
    }
}