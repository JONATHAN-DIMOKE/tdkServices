<?php
/**
 * Created by PhpStorm.
 * User: Josh DIMOKE
 * Date: 12/01/2022
 * Time: 14:03
 */

require_once "config/config.php";
require_once "model/DAO/ConnectionDAO.class.php";
require_once "model/DAO/UtilisateurDAO.class.php";
require_once 'model/entity/Utilisateur.class.php';
require_once "partial/errorManage.view.php";

function displayLoginForm(){
    try{
        UtilisateurDAO::createFirstUser();
        require "view/auth-login.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function login($codeAgent, $pwd){
    try{
        $resultDB = UtilisateurDAO::connectUser($codeAgent, $pwd);
        if($resultDB['codeAgent']){
            $_SESSION['user'] = $resultDB;
            //$numberUsers = UtilisateurDAO::countNumberUsers();
            /*echo "<pre>";
                print_r($_SESSION['user']);
            UtilisateurDAO::countNumberMessagesByCandidat($_SESSION['user']['id'])
            echo "</pre>"; */
            UtilisateurDAO::updateConnectionState($_SESSION['user']['codeAgent'], $_SESSION['user']['pwd']);
            if($_SESSION['user']['typeUser'] == "Responsable CUR"){
                require "view/index.php";
            }elseif ($_SESSION['user']['typeUser'] == "Admin"){
                require "view/indexAdmin.php";
            }elseif ($_SESSION['user']['typeUser'] == "Responsable TK"){
                require "view/indexRespTK.php";
            }elseif ($_SESSION['user']['typeUser'] == "Gerant"){
                require "view/indexGerant.php";
            }

        }else{
            require "view/auth-login.php";
        }
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayFormForgot(){
    try{
        require "view/auth-forgot-password.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayLogin(){
    try{
        require "view/auth-login.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayFormChangerPwd(){
    try{
        require "view/auth-reset-password.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function disconnected(){
    try{
        UtilisateurDAO::updateConnectionState($_SESSION['user']['codeAgent'], $_SESSION['user']['pwd']);
        session_destroy();
        require "view/auth-login.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function configProfile(){
    try{
        require "view/profile.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function principalPage(){
    try{
        require "view/index.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function saveClient($nom, $tel, $genre, $categorie, $adresse){
    try{
        $resultBD = UtilisateurDAO::getAllClients();
        $client = new Utilisateur(0, '',$nom, $tel, $genre,
                                '','Client', $categorie,'',
                                '','',$adresse);
        UtilisateurDAO::saveClient($client);
        require "view/vendreUnite.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function saveClientTelecom($nom, $tel, $genre, $categorie, $adresse){
    try{
        $resultBD = UtilisateurDAO::getAllClients();
        $client = new Utilisateur(0, '',$nom, $tel, $genre,
            '','Client', 'Telecom','',
            '','',$adresse);
        UtilisateurDAO::saveClient($client);
        require "view/reabonnerClient.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function affectPhone($idClient, $idRespCUR, $tel, $reseau){
    try{
        $resultBD = UtilisateurDAO::getAllClients();
        UtilisateurDAO::affectPhone($idClient, $idRespCUR, $tel, $reseau);
        require "view/vendreUnite.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function getAllReseaux($idClient){
    try{
        $listReseaux = UtilisateurDAO::getAllReseaux($idClient);
        require "view/confirmerVenteUnite.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function forgotPwd($newPwd, $codeAgent){
    try{
        UtilisateurDAO::forgotPwd($newPwd, $codeAgent);
        require "view/auth-login.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function facture(){
    try{
        require "view/facture.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function reconfigurerCompte($nom, $tel, $adresse, $etatCivil, $genre){
    try{
        UtilisateurDAO::reconfigureAccount($_SESSION['user']['id'], $nom, $tel, $adresse, $etatCivil, $genre);
        disconnected();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function indexGerant(){
    try{
        require "view/indexGerant.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function configVenteUnite(){
    try{
        $listAllConfigVenteUnite = LigneRechargeDAO::getAllConfigVenteUnite();
        $listUsers = UtilisateurDAO::getAllUsers();
        require "view/configVenteUnite.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function displayConfigTauxDuJour(){
    try{
        $listTaux = TauxDAO::getAllTaux($_SESSION['user']['id']);
        require "view/configTauxAndDateRecharge.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function configTauxDuJour($montantTaux, $dateJour, $idGerant){
    try{
        $listTaux = TauxDAO::getAllTaux($idGerant);
        $listDateRecharge = UtilisateurDAO::getAllDateRecharge();
        TauxDAO::configTauxDuJour($montantTaux, $dateJour, $idGerant);
        require "view/configTauxAndDateRecharge.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function configDateRecharge($jour, $mois, $annee, $heure){
    try{
        $listTaux = TauxDAO::getAllTaux($_SESSION['user']['id']);
        $listDateRecharge = UtilisateurDAO::getAllDateRecharge();
        UtilisateurDAO::configDateRecharge($jour, $mois, $annee, $heure);
        require "view/configTauxAndDateRecharge.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function manageUsersAccounts(){
    try{
        $listAllUsers = UtilisateurDAO::getAllUsers();
        require "view/manageUsersAccounts.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}
function updateUserAccount($idUser){
    try{
        UtilisateurDAO::updateStatusUserAccount($idUser);
        manageUsersAccounts();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function createUser($utilisateur){
    try{
        UtilisateurDAO::createUser($utilisateur);
        manageUsersAccounts();
    }catch (Exception $ex){
        errorManage($ex);
    }
}

function consultEtatConnection(){
    try{
        $compteur = 1;
        $listAllUsers = UtilisateurDAO::getAllUsers();
        require "view/etatConnection.php";
    }catch (Exception $ex){
        errorManage($ex);
    }
}