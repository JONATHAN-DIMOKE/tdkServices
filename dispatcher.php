<?php
    session_start();
    require_once "control/utilisateur.control.php";
    require_once "control/venteUnite.control.php";
    require_once "control/venteKit.control.php";
    require_once "control/reabonnement.control.php";
    require_once "control/change.control.php";
    require_once "control/dette.control.php";
    require_once "control/rapport.control.php";
    require_once "control/e-banking.control.php";
    require_once "control/signalerDepense.control.php";


    if(isset($_GET['action'])){
        if($_GET['action'] == "resetPwd"){
            displayFormForgot();
        }elseif($_GET['action'] == "login"){
            displayLogin();
        }elseif ($_GET['action'] == "connected"){
            login($_POST['codeAgent'], $_POST['pwd']);
        }elseif ($_GET['action'] == "changePwd"){
            displayFormChangerPwd();
        }elseif ($_GET['action'] == "configProfile"){
            configProfile();
        }
        elseif ($_GET['action'] == "disconnected"){
            disconnected();
        }elseif ($_GET['action'] == "displayFormVendreUnite"){
            displayFormVendreUnite();
        }elseif ($_GET['action'] == "saveClient"){
            saveClient($_POST['nom'], $_POST['tel'],$_POST['genre'], $_POST['categorie'], $_POST['adresse']);
        }elseif ($_GET['action'] == "affectPhone"){
           affectPhone($_POST['idClient'], $_SESSION['user']['id'], $_POST['tel'], $_POST['reseau']);
        }elseif ($_GET['action'] == "displayFormConfirmerVenteUnite"){
            displayFormConfirmerVenteUnite($_GET['idClient']);
        }elseif ($_GET['action'] == "forgotPwd"){
            forgotPwd($_POST['newPwd'], $_POST['codeAgent']);
        }elseif ($_GET['action'] == "confirmerVenteUnite"){
            confirmerVenteUnite($_POST['idTel'], $_POST['reseau'], $_POST['idMontant'], $_SESSION['numVente']);
        }elseif ($_GET['action'] == "displayFormGererDette"){
            displayFormGererDette();
        }elseif ($_GET['action'] == "displayFormModifierDette"){
            displayFormModifierDette($_GET['idClient'], $_GET['refDette']);
        }elseif ($_GET['action'] == "activateDeactivateDette"){
            activateDeactivateDette($_GET['id'], $_GET['operation']);
        }elseif ($_GET['action'] == "saveDette"){
            saveDette($_POST['idClient'], $_POST['idMontant'],$_POST['reseau']);
            confirmerVenteUnite($_POST['idTel'], $_POST['reseau'], $_POST['idMontant']);
        }elseif ($_GET['action'] == "traiterDette"){
            traiterDette($_POST['idProduit'], $_POST['idClient'], $_POST['montant'], $_SESSION['user']['id'],$_POST['reseau'], $_POST['refDette']);
        }elseif ($_GET['action'] == "displayFormReabonnement"){
            displayFormReabonnement();
        }elseif ($_GET['action'] == "saveClientTelecom"){
            saveClientTelecom($_POST['nom'], $_POST['tel'],$_POST['genre'], $_POST['categorie'], $_POST['adresse']);
        }elseif ($_GET['action'] == "affectCodeDecodeur"){
            affectCodeDecodeur($_POST['idClient'], $_SESSION['user']['id'], $_POST['codeDecodeur'], $_POST['denomination']);
        }elseif ($_GET['action'] == "displayFormConfirmeReabonnement"){
            getAllDenomination($_GET['idClient']);
        }elseif ($_GET['action'] == "confirmerReabonnement"){
            confirmerReabonnement($_SESSION['user']['id'],$_POST['denomination'], $_POST['codeDecodeur'], $_POST['montant'],'Reabonnement');
        }elseif ($_GET['action'] == "displayFormChangeDollard"){
            displayFormChangeDollard();
        }elseif ($_GET['action'] == "saveCapitalChange"){
            saveCapitalChange($_SESSION['user']['id'],$_POST['capitalC'], $_POST['idDateRecharge'], $_POST['changeC'], $_POST['tauxC'], $_POST['resteC']);
        }elseif($_GET['action']== "saveHistoriqueChange"){
            saveHistoriqueChange($_SESSION['user']['id'], $_POST['montantUSD'], $_POST['montantCDF']);
        }elseif ($_GET['action'] == "resetTable"){
            resetTableu();
        }elseif ($_GET['action'] == "displayFormReport"){
            displayFormReport();
        }elseif ($_GET['action'] == "displayFormReportReabonner"){
            displayFormReportReabonner();
        }elseif ($_GET['action'] == "displayFormReportSaleUntite"){
            displayFormReportSaleUnite();
        }elseif ($_GET['action'] == "displayFacture"){
            facture();
        }elseif ($_GET['action'] == "reconfigureAccount"){
            reconfigurerCompte($_POST['nom'], $_POST['tel'], $_POST['adresse'], $_POST['etatCivil'], $_POST['genre']);
        }elseif ($_GET['action'] == "indexGerant"){
            indexGerant();
        }elseif ($_GET['action'] == "configVenteUnite"){
            configVenteUnite();
        }elseif ($_GET['action'] == "configBalanceVenteUnite"){
            configBalanceVenteUnite($_POST['idRespCUR'],$_POST['reseauU'], $_POST['ballanceU'], $_POST['newBallanceU']);
        }elseif ($_GET['action'] == "approvCompteUnite"){
            approvCompteUnite($_POST['reseauU'],$_POST['approvU']);
        }elseif ($_GET['action'] == "displayFormConfigReabonnement"){
            displayFormConfigReabonnement();
        }elseif ($_GET['action'] == "configBalanceReabonnement"){
            configReabonnement($_POST['idRespCUR'], $_POST['denominationR'], $_POST['ballanceR'], $_POST['newBallanceR'], $_SESSION['user']['id']);
        }elseif ($_GET['action'] == "approvCompteReabonnement"){
            approvCompteReabonnement($_POST['denominationR'], $_POST['approvR']);
        }elseif ($_GET['action'] == "displayConfigTauxDuJour"){
            displayConfigTauxDuJour();
        }elseif ($_GET['action'] == "configTauxJour"){
            configTauxDuJour($_POST['montantTaux'], $_POST['dateTauxJour'], $_SESSION['user']['id']);
        }elseif ($_GET['action'] == "configDateRecharge"){
            configDateRecharge($_POST['jour'], $_POST['mois'],$_POST['annee'], $_POST['heure']);
        }elseif ($_GET['action'] == "archive"){
            archiverBalanceReabonne($_GET['id']);
        }elseif ($_GET['action'] == "approvVenteUnite"){
            approvCompteUnite($_POST['reseauU'], $_POST['approvU']);
        }elseif ($_GET['action'] == "printInvoice"){
            printInvoice($_SESSION['user']['id']);
        }
        elseif ($_GET['action'] == "updateStatePrint"){
            updateStatePrint($_SESSION['numVente']);
        }elseif ($_GET['action'] == "displayListInvoicesNotPrint"){
            displayListInvoicesNotPrint();
        }
        elseif ($_GET['action'] == "manageUsersAccounts"){
            manageUsersAccounts();
        }elseif ($_GET['action'] == "updateUserAccount"){
            updateUserAccount($_GET['idUser']);
        }elseif ($_GET['action'] == "createUser"){
            $user = new Utilisateur(0, '',$_POST['nom'], $_POST['tel'], $_POST['genre'],
                $_POST['etatCivil'], $_POST['typeUser'],'',
                '','','',$_POST['adresse']);
            createUser($user);
        }
        elseif ($_GET['action'] == "consultEtatConnection"){
            consultEtatConnection();
        }elseif ($_GET['action'] == "consultHistoriquesChange"){
            consultHistoriquesChange();
        }elseif ($_GET['action'] == "consultHistoriquesSalesUnite"){
            consultHistoriquesSalesUnite();
        }elseif ($_GET['action'] == "consultHistoriquesReabonnement"){
            consultHistoriquesReabonnement();
        }elseif ($_GET['action'] == "configMontantInitialEspece"){
            configMontantInitialEspece();
        }elseif ($_GET['action'] == "affectMontantInitial"){
            affectMontantInitial($_POST['montantEnEspere'], $_SESSION['user']['id'], $_POST['raison'],  $_POST['idRespCUR']);
        }elseif ($_GET['action'] == "displayFormConfigE_banking"){
            displayFormConfigE_banking();
        }elseif ($_GET['action'] == "configE_banking"){
            configE_banking($_POST['reseauE'], $_POST['stockInitialcdfE'], $_POST['stockInitialusdE'], $_POST['idRespTK'], $_SESSION['user']['id'], $_POST['montantInitialEspeceE'], $_POST['tauxC']);
        }elseif ($_GET['action'] == "approvE_banking"){
            approvE_banking($_POST['reseauE'], $_POST['devise'], $_POST['montantApprovE'], $_SESSION['user']['id']);
        }elseif ($_GET['action'] == "displayTransactionE_banking"){
            displayTransactionE_banking();
        }elseif ($_GET['action'] == "indexRespTK"){
            displayIndexRespTK();
        }elseif ($_GET['action'] == "saveClientE_banking"){
            saveClientE_banking($_POST['nom'], $_POST['tel'],$_POST['genre'], $_POST['categorie'], $_POST['adresse']);
        }elseif ($_GET['action'] == "displayFormConfirmE_banking"){
            displayFormConfirmE_banking($_GET['idClient']);
        }elseif ($_GET['action'] == "conformTransactionE_banking"){
            conformTransactionE_banking($_POST['idTel'], $_POST['reseau'], $_POST['idMontant'], $_SESSION['numVente'], $_POST['devise']);
        }elseif ($_GET['action'] == "cloreJour"){
            cloreJour($_POST['montantClotureUSD'], $_POST['montantClotureCDF'], $_POST['reseauE']);
        }elseif ($_GET['action'] == "displaySaleKitTV"){
            displaySaleKitTV();
        }elseif ($_GET['action'] == "displayConfigKit"){
            displayConfigKit();
        }elseif ($_GET['action'] == "configKitTV"){
            configKitTV($_POST['denominationK'], $_POST['stockInitialK'], $_POST['puK'], $_POST['idRespTK'], $_SESSION['user']['id']);
        }elseif ($_GET['action'] == "approvKitTV"){
            approvKitTV($_POST['denominationK'], $_POST['approvK']);
        }elseif ($_GET['action'] == "displaySaleKitTVRespKT"){
            displaySaleKitTVRespKT();
        }elseif ($_GET['action'] == "confirmSaleKitTV"){
            confirmSaleKitTV($_POST['denominationK'], $_POST['venteK'], $_SESSION['user']['id'], $_POST['idClient']);
        }elseif ($_GET['action'] == "displayCreateCommission"){
            displayCreateCommission();
        }elseif ($_GET['action'] == "confirmCommission"){
            confirmCommission($_POST['reseauCOM'], $_POST['commissionInitialeCDF'], $_POST['commissionInitialeUSD'], $_POST['commissionFinaleCDF'], $_POST['commissionFinaleUSD'], $_POST['beneficeCDF'], $_POST['beneficeUSD'], $_SESSION['user']['id']);
        }elseif ($_GET['action'] == "reportCommission"){
            reportCommission();
        }elseif ($_GET['action'] == "reportKitTV"){
            reportKitTV();
        }elseif ($_GET['action'] == "reportE_banking"){
            getAllE_bankingRespTK();
        }elseif ($_GET['action'] == "displaySignalerDepenses"){
            displaySignalerDepenses();
        }elseif ($_GET['action'] == "creerDepense"){
            creerDepense($_POST['typeDepense'], $_POST['montantSortieEnCaisse'],$_POST['raison'],$_POST['nomDemandeur'], $_SESSION['user']['id']);
        }elseif ($_GET['action'] == "epurerDepense"){
            epurerDepense($_GET['idDepense']);
        }
        else{
            principalPage();
        }
    }else{
        displayLoginForm();
    }
