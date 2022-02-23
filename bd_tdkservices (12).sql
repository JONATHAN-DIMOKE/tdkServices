-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 22 fév. 2022 à 15:34
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_tdkservices`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllRespTK` ()  BEGIN
	SELECT * FROM t_utilisateur WHERE typeUser = 'Responsable TK' AND statut = 'Actif';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_AcitvateDeactivateDette` (IN `p_id` INT, IN `p_operation` VARCHAR(20))  NO SQL
BEGIN
    
    IF p_operation = "Desactiver" THEN
    	UPDATE t_dette SET t_dette.etatDette = "Non paye"
        WHERE t_dette.id = p_id;
    ELSE
    	UPDATE t_dette SET t_dette.etatDette = "Paye" 
        WHERE t_dette.id = p_id;
    END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_affectCodeDecodeur` (IN `p_idClient` INT, IN `p_idUtulisateur` INT, IN `p_codeDecodeur` VARCHAR(50), `p_denomination` VARCHAR(70))  BEGIN
	INSERT t_decodeur(id, idClient, idRespCUR, codeDecodeur, denomination) VALUES(0, p_idClient, p_idUtulisateur, p_codeDecodeur, p_denomination);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_affectMontantEnEspece` (IN `p_montantEspece` FLOAT, IN `p_idGerant` INT, IN `p_raison` TEXT, IN `p_idRespCUR` INT)  BEGIN
DECLARE v_lastIdMontant INT;
DECLARE v_idProdUnite INT;

SELECT id INTO v_idProdUnite FROM t_produit WHERE designation = 'E-banking';
	
    INSERT t_motantespece(id, montantEnEspere, dateCreatioin, idUtilisateur, devise, raison) VALUES(0, p_montantEspece, NOW(), p_idGerant, 'CDF', p_raison);
    
    SELECT id INTO v_lastIdMontant FROM t_motantespece ORDER BY id DESC LIMIT 1;
    
    INSERT t_affectermontantenespece(id, idProduit, idMontant, dateAffectation, idRespCUR) VALUES(0, v_idProdUnite, v_lastIdMontant, NOW(), p_idRespCUR);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_affectPhone` (IN `p_idClient` INT, IN `p_idUtulisateur` INT, IN `p_tel` VARCHAR(14), IN `p_reseau` VARCHAR(50))  BEGIN
	INSERT t_telephone(id, idClient, idRespCUR, tel, reseau) VALUES(0, p_idClient, p_idUtulisateur, p_tel, p_reseau);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_approvCompte` (IN `p_reseau` VARCHAR(100), IN `p_qteApprov` INT)  BEGIN
	DECLARE v_idLigneRecharge INT;
    DECLARE v_ancienneNewBalance FLOAT;
    
	SELECT id INTO v_idLigneRecharge FROM t_lignerecharge WHERE ballanceU <> 0 AND reseauU = p_reseau ORDER BY id DESC LIMIT 1;
    
    SELECT newBallanceU INTO v_ancienneNewBalance FROM t_lignerecharge WHERE ballanceU <> 0 AND reseauU = p_reseau ORDER BY id DESC LIMIT 1;
    
    UPDATE t_lignerecharge SET approvU = p_qteApprov, newBallanceU = newBallanceU + p_qteApprov WHERE id = v_idLigneRecharge;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_approvCompteReabonnement` (IN `p_denomination` VARCHAR(100), IN `p_qteApprov` FLOAT)  BEGIN
	DECLARE v_idLigneRecharge INT;
    DECLARE v_ancienneNewBalance FLOAT;
    
	SELECT id INTO v_idLigneRecharge FROM t_lignerecharge WHERE ballanceR <> 0 AND denominationR = p_denomination ORDER BY id DESC LIMIT 1;
    
    SELECT newBallanceR INTO v_ancienneNewBalance FROM t_lignerecharge WHERE ballanceR <> 0 AND denominationR = p_denomination ORDER BY id DESC LIMIT 1;
    
    UPDATE t_lignerecharge SET approvR = p_qteApprov, newBallanceR = newBallanceR + p_qteApprov WHERE id = v_idLigneRecharge;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_approvE_banking` (IN `p_reseauE` VARCHAR(50), IN `p_devise` CHAR(3), IN `p_montantApprov` FLOAT, IN `p_idGerant` INT)  BEGIN 
	DECLARE v_idLigneRecharge INT;
    DECLARE v_idDateRecharge INT;
    
  
    SELECT id INTO v_idLigneRecharge FROM t_lignerecharge WHERE (newStockusdE <> 0  OR newStockcdfE <> 0) AND reseauE = p_reseauE ORDER BY id DESC LIMIT 1;
    
     SELECT id INTO v_idDateRecharge FROM t_daterecharge ORDER BY id DESC LIMIT 1;
    
    IF p_devise = 'USD' THEN
    	 UPDATE t_lignerecharge SET approvusdE = approvusdE + p_montantApprov, newStockusdE = newStockusdE + p_montantApprov WHERE id = v_idLigneRecharge;
    ELSE
    UPDATE t_lignerecharge SET approvcdfE = approvcdfE + p_montantApprov, newStockcdfE = newStockcdfE + p_montantApprov WHERE id = v_idLigneRecharge;
    END IF;
    
    INSERT INTO t_historiqueapprove_banking(id, idGerant, montantApprov, devise, idDateApprov) VALUES(0, p_idGerant, p_montantApprov, p_devise, v_idDateRecharge);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_approvKitTV` (IN `p_denomination` VARCHAR(100), IN `p_qteApprov` INT)  BEGIN
	DECLARE v_idLigneRecharge INT;
    DECLARE v_lastNewStock FLOAT;
    
	SELECT id INTO v_idLigneRecharge FROM t_lignerecharge WHERE stockinitialK <> 0 AND denominationK = p_denomination ORDER BY id DESC LIMIT 1;
    
    SELECT newStockK INTO v_lastNewStock FROM t_lignerecharge WHERE stockinitialK <> 0 AND denominationK = p_denomination ORDER BY id DESC LIMIT 1;
    
    UPDATE t_lignerecharge SET approvK = p_qteApprov, newStockK = newStockK + p_qteApprov WHERE id = v_idLigneRecharge;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_archiverArtivite` (IN `p_idLigneRecharge` INT)  BEGIN
	UPDATE t_lignerecharge SET etatOperation = "Archive" WHERE id = p_idLigneRecharge;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_cloreJour` (IN `p_montantClotureUSD` FLOAT, IN `p_montantClotureCDF` FLOAT, IN `p_reseauE` VARCHAR(50))  BEGIN
	DECLARE v_id INT;
    DECLARE v_resultUSD FLOAT;
    DECLARE v_resultCDF FLOAT;
    DECLARE v_newStockUSD FLOAT;
    DECLARE v_newStockCDF FLOAT;
    DECLARE v_lastStockInitialCdfE FLOAT;
    DECLARE v_lastStockInitialUsdE FLOAT;
    DECLARE v_lastEntreeUsdE FLOAT;
    DECLARE v_lastEntreeCdfE FLOAT;
    DECLARE v_lastMontantInitialEspece FLOAT;
    DECLARE v_lastSortieUsdE FLOAT;
    DECLARE v_lastSortieCdfE FLOAT;
    DECLARE v_lastProduit INT;
    DECLARE v_lastDateRecharge INT;
    DECLARE v_lastIdUtilisateur INT;
    DECLARE v_lastIdTel INT;
    DECLARE v_lastGerant INT;
    DECLARE v_lastMontantClotureUsdE FLOAT;
     DECLARE v_lastMontantClotureCdfE FLOAT;
    
    SELECT id INTO v_id FROM t_lignerecharge WHERE ((newStockcdfE <> 0 OR newStockusdE <> 0) AND (montantCloturecdfE = 0 AND montantClotureusdE = 0)) AND reseauE = p_reseauE ORDER BY id DESC LIMIT 1;
    
    SELECT newStockcdfE INTO v_newStockCDF FROM t_lignerecharge WHERE id = v_id;
    SELECT newStockusdE INTO v_newStockUSD FROM t_lignerecharge WHERE id = v_id;
   
   SET @v_resultUSD := p_montantClotureUSD - v_newStockUSD;
   SET @v_resultCDF := p_montantClotureCDF - v_newStockCDF;
   
   IF p_montantClotureUSD - v_newStockUSD > 0 AND p_montantClotureCDF - v_newStockCDF > 0 THEN
   		UPDATE t_lignerecharge SET etatOperation = 'Close', montantCloturecdfE = p_montantClotureCDF, montantClotureusdE = p_montantClotureUSD, entreeusdE = abs(p_montantClotureUSD - v_newStockUSD), entreecdfE =  abs(p_montantClotureCDF - v_newStockCDF) WHERE id = v_id;
   ELSEIF p_montantClotureUSD - v_newStockUSD > 0 AND  p_montantClotureCDF - v_newStockCDF < 0 THEN
   		UPDATE t_lignerecharge SET etatOperation = 'Close', montantCloturecdfE = p_montantClotureCDF, montantClotureusdE = p_montantClotureUSD, entreeusdE = abs(p_montantClotureUSD - v_newStockUSD), sortiecdfE =  abs(p_montantClotureCDF - v_newStockCDF) WHERE id = v_id;
   ELSEIF p_montantClotureUSD - v_newStockUSD < 0 AND  p_montantClotureCDF - v_newStockCDF > 0 THEN
   		UPDATE t_lignerecharge SET etatOperation = 'Close', montantCloturecdfE = p_montantClotureCDF, montantClotureusdE = p_montantClotureUSD, sortieusdE = abs(p_montantClotureUSD - v_newStockUSD), entreecdfE =  abs(p_montantClotureCDF - v_newStockCDF) WHERE id = v_id;
   ELSE
   		UPDATE t_lignerecharge SET etatOperation = 'Close', montantCloturecdfE = p_montantClotureCDF, montantClotureusdE = p_montantClotureUSD, sortieusdE = abs(p_montantClotureUSD - v_newStockUSD), sortiecdfE =  abs(p_montantClotureCDF - v_newStockCDF) WHERE id = v_id;
    END IF;
    
    SELECT stockinitialcdfE INTO v_lastStockInitialCdfE FROM t_lignerecharge WHERE id = v_id;
    SELECT stockinitialusdE INTO v_lastStockInitialUsdE FROM t_lignerecharge WHERE id = v_id;
    SELECT entreecdfE INTO v_lastEntreeCdfE FROM t_lignerecharge WHERE id = v_id;
    SELECT entreeusdE INTO v_lastEntreeUsdE FROM t_lignerecharge WHERE id = v_id;
    SELECT montantInitialEspeceE INTO v_lastMontantInitialEspece FROM t_lignerecharge WHERE id = v_id;
    SELECT sortieusdE INTO v_lastSortieUsdE FROM t_lignerecharge WHERE id = v_id;
    SELECT sortiecdfE INTO v_lastSortieCdfE FROM t_lignerecharge WHERE id = v_id;

    
    SELECT idProduit INTO v_lastProduit FROM t_lignerecharge WHERE id = v_id;
    SELECT idDateRecharge INTO v_lastDateRecharge FROM t_lignerecharge WHERE id = v_id;
    SELECT idUtilisateur INTO v_lastIdUtilisateur FROM t_lignerecharge WHERE id = v_id;
    SELECT idTel INTO v_lastIdTel FROM t_lignerecharge WHERE id = v_id;
    SELECT idGerant INTO v_lastGerant FROM t_lignerecharge WHERE id = v_id;
    SELECT montantCloturecdfE INTO v_lastMontantClotureCdfE FROM t_lignerecharge WHERE id = v_id;
    SELECT montantClotureusdE INTO v_lastMontantClotureUsdE FROM t_lignerecharge WHERE id = v_id;
    
   INSERT INTO t_lignerecharge(idProduit, idDateRecharge, idTel, idUtilisateur, idGerant, reseauE, montantInitialEspeceE, stockinitialusdE, stockinitialcdfE) VALUES(v_lastProduit,v_lastDateRecharge, v_lastIdTel,v_lastIdUtilisateur, v_lastGerant, p_reseauE, v_lastMontantInitialEspece + abs(((v_lastEntreeUsdE * 2000) + v_lastEntreeCdfE)) - abs(((v_lastSortieUsdE * 2000) + v_lastSortieCdfE)),v_lastMontantClotureUsdE ,v_lastMontantClotureCdfE );

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_configDateRecharge` (IN `p_jour` INT, IN `p_mois` INT, IN `p_annee` INT, IN `p_heure` VARCHAR(10))  BEGIN
	INSERT INTO t_daterecharge(id, jour, mois, annee, heure, dateComplet) VALUES(0, p_jour, p_mois, p_annee, p_heure, NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_configE_banking` (IN `p_reseauE` VARCHAR(50), IN `p_stockInitialEspeceCDF` FLOAT, IN `p_stockInitialEspeceUSD` FLOAT, IN `p_idRespTK` INT, IN `p_idGerant` INT, IN `p_montantEspece` FLOAT, IN `p_taux` FLOAT)  BEGIN
	DECLARE v_idProduit INT;
    DECLARE v_idDateRecharge INT;
    
     SELECT id INTO v_idProduit FROM t_produit WHERE designation = 'E-banking';
	SELECT id INTO v_idDateRecharge FROM t_daterecharge ORDER BY id DESC LIMIT 1;
    
    INSERT INTO t_lignerecharge(id, idProduit, idDateRecharge, idUtilisateur, idGerant, etatOperation, reseauE, montantInitialEspeceE, stockinitialusdE, stockinitialcdfE, newStockcdfE, newStockusdE, tauxC) VALUES(0, v_idProduit, v_idDateRecharge, p_idRespTK, p_idGerant, 'En cours', p_reseauE, p_montantEspece, p_stockInitialEspeceUSD, p_stockInitialEspeceCDF, p_stockInitialEspeceCDF, p_stockInitialEspeceUSD, p_taux);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_configKit_TV` (IN `p_denominationK` VARCHAR(50), IN `p_stockInitialK` INT, IN `p_puK` FLOAT, IN `p_idRespTK` INT, IN `p_idGerant` INT)  BEGIN
	DECLARE v_idProduit INT;
    DECLARE v_idDateRecharge INT;
    
     SELECT id INTO v_idProduit FROM t_produit WHERE designation = 'Kit' AND etatProduit = 'En vente';
	SELECT id INTO v_idDateRecharge FROM t_daterecharge ORDER BY id DESC LIMIT 1;
    
    INSERT INTO t_lignerecharge(id, idProduit, idDateRecharge, idUtilisateur, idGerant, etatOperation, denominationK, stockinitialK, newStockK, puK, stockRestantK) VALUES(0, v_idProduit, v_idDateRecharge, p_idRespTK, p_idGerant, 'En cours', p_denominationK, p_stockInitialK, p_stockInitialK, p_puK, p_stockInitialK);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_configReannement` (IN `p_idUtilisateur` INT, IN `p_denomination` VARCHAR(100), IN `p_balanceR` FLOAT, IN `p_newBalanceR` FLOAT, IN `p_idGerant` INT)  BEGIN
	DECLARE v_idDateRecharge INT;
    DECLARE v_idProduit INT;
    DECLARE v_numberLigne INT;
    DECLARE v_idLigne INT;
    
	SELECT id INTO v_idDateRecharge FROM t_daterecharge ORDER BY id DESC LIMIT 1;
    SELECT id INTO v_idProduit FROM t_produit WHERE designation = 'Reabonnement';
    
    SELECT COUNT(*) INTO v_numberLigne FROM t_lignerecharge WHERE ballanceR <> 0 AND denominationR = p_denomination;
    
    SELECT id INTO v_idLigne FROM t_lignerecharge WHERE ballanceR <> 0 AND denominationR = p_denomination ORDER BY id DESC LIMIT 1;
    
    IF v_numberLigne <> 0 THEN
    INSERT t_lignerecharge(idProduit, idDateRecharge, idUtilisateur,idGerant, denominationR, ballanceR, newBallanceR, restantR) VALUES(v_idProduit, v_idDateRecharge, p_idUtilisateur,p_idGerant, p_denomination, p_balanceR, p_newBalanceR, ballanceR);
    
    UPDATE t_lignerecharge SET etatOperation = 'Archive' WHERE id = v_idLigne;
ELSE
INSERT t_lignerecharge(idProduit, idDateRecharge, idUtilisateur,idGerant, denominationR, ballanceR, newBallanceR, restantR) VALUES(v_idProduit, v_idDateRecharge, p_idUtilisateur,p_idGerant, p_denomination, p_balanceR, p_newBalanceR, ballanceR);
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_configSaleUnite` (IN `p_idUtilisateur` INT, IN `p_reseauU` VARCHAR(100), IN `p_balanceU` FLOAT, IN `p_newBalanceU` FLOAT)  BEGIN
	DECLARE v_idDateRecharge INT;
	SELECT id INTO v_idDateRecharge FROM t_daterecharge ORDER BY id DESC LIMIT 1;
    
    INSERT t_lignerecharge(idProduit, idDateRecharge, idUtilisateur, reseauU, ballanceU, newBallanceU) VALUES(1, v_idDateRecharge, p_idUtilisateur, p_reseauU, p_balanceU, p_newBalanceU);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_configTaux` (IN `p_montantTaux` FLOAT, IN `p_dateJour` VARCHAR(40), IN `p_idGerant` INT)  BEGIN
	INSERT INTO t_taux(id, montant, dateCreation, dateTauxJour, idUtilisateur) VALUES(0, p_montantTaux, NOW(), p_dateJour,  p_idGerant);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_confirmCommission` (IN `p_reseauCOM` VARCHAR(250), IN `p_commissionInitialeCDF` FLOAT, IN `p_commissionInitialeUSD` FLOAT, IN `p_commissionFinaleCDF` FLOAT, IN `p_commissionFinaleUSD` FLOAT, IN `p_beneficeCDF` FLOAT, IN `p_beneficeUSD` FLOAT, IN `p_idRespTK` INT)  BEGIN

    DECLARE v_idProduit INT DEFAULT 0;
    DECLARE v_idDateRecharge INT DEFAULT 0;
    
	SELECT id INTO v_idDateRecharge FROM t_daterecharge ORDER BY id DESC LIMIT 1;
    SELECT id INTO v_idProduit FROM t_produit WHERE t_produit.designation = 'Commission';
    
    INSERT INTO t_lignerecharge(idProduit, idDateRecharge, idUtilisateur, etatOperation, reseauCOM, commissionInitialeCDF, commissionInitialeUSD, commissionFinaleCDF, commissionFinaleUSD, beneficeCDF, beneficeUSD) VALUES(v_idProduit, v_idDateRecharge, p_idRespTK, 'En cours', p_reseauCOM, p_commissionInitialeCDF, p_commissionInitialeUSD, p_commissionFinaleCDF, p_commissionFinaleUSD, p_beneficeCDF, p_beneficeUSD);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_confirmerVente` (IN `p_idTel` INT, IN `p_reseau` VARCHAR(50), IN `p_montant` FLOAT, IN `p_idRespCUR` INT, IN `p_operation` VARCHAR(50))  BEGIN 
	DECLARE v_idProduit INT;
    DECLARE v_idRecharge INT;
    DECLARE v_ancienneBalance FLOAT;
    DECLARE v_newBalance FLOAT;
    DECLARE v_approvU FLOAT;
    DECLARE v_pu FLOAT;
    
     
	INSERT t_venteunite(id, idRespCUR, idTel, montant, dateVente) VALUES(0,          p_idRespCUR, p_idTel, p_montant, NOW());
    
    SELECT puU INTO v_pu FROM t_lignerecharge WHERE ballanceU <> '' ORDER BY id DESC LIMIT 1;
    SELECT id INTO v_idProduit FROM t_produit WHERE designation = 'Unite'; 
    SELECT id INTO v_idRecharge FROM `t_daterecharge` ORDER BY id DESC LIMIT 1;
    SELECT newBallanceU INTO v_ancienneBalance FROM t_lignerecharge ORDER BY id DESC LIMIT 1;
    SELECT approvU INTO v_approvU FROM t_lignerecharge ORDER BY id DESC LIMIT 1;
 

   
    IF p_operation = 'Unite' THEN
    	INSERT t_lignerecharge(id, idProduit, idDateRecharge, idTel,ballanceU ,newBallanceU , approvU,reseauU, venteU, puU, soldeU)          VALUES(0, v_idProduit, v_idRecharge, p_idTel, v_ancienneBalance - p_montant,v_ancienneBalance - p_montant,v_approvU,p_reseau, p_montant, v_pu, p_montant * v_pu);
   END IF;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_confirmReabonnement` (IN `p_idRespCUR` INT, IN `p_idDecodeur` INT, IN `p_montant` FLOAT, IN `p_operation` VARCHAR(50), IN `p_denomination` VARCHAR(100))  BEGIN 
    DECLARE v_idRecharge INT;
    DECLARE v_ancienneBalance FLOAT;
    DECLARE v_newBalance FLOAT;
    DECLARE v_approvR FLOAT;
    DECLARE v_pu FLOAT;
    DECLARE v_restantR FLOAT;
    DECLAre v_soldeR FLOAT;
    DECLARE v_idProduit INT;
    DECLARE v_idDateRecharge INT;
    DECLARE v_idLigneRecharge INT;
    
    SELECT id INTO v_idProduit FROM t_produit WHERE designation = 'Reabonnement';
    
    SELECT id INTO v_idDateRecharge FROM `t_daterecharge` order by id desc limit 1;
    
    SELECT ballanceR INTO v_ancienneBalance from t_lignerecharge WHERE ballanceR <> 0 and denominationR = p_denomination order by id desc limit 1;
    
      
    SELECT soldeR + p_montant INTO v_soldeR from t_lignerecharge WHERE ballanceR <> 0 and denominationR = p_denomination order by id desc limit 1;
    
    SELECT newBallanceR - v_soldeR INTO v_restantR from t_lignerecharge WHERE ballanceR <> 0 and denominationR = p_denomination order by id desc limit 1;
    
  SELECT id INTO v_idLigneRecharge FROM t_lignerecharge WHERE ballanceR <> 0 AND etatOperation = 'En cours' AND denominationR = p_denomination ORDER BY id DESC LIMIT 1;
    
        SELECT newBallanceR INTO v_newBalance from t_lignerecharge WHERE ballanceR <> 0 and denominationR = p_denomination order by id desc limit 1;
       
     IF v_restantR >= p_montant THEN
         UPDATE t_lignerecharge SET idUtilisateur = p_idRespCUR, idProduit = v_idProduit, idDateRecharge = v_idDateRecharge, denominationR = p_denomination, ballanceR = v_ancienneBalance, newBallanceR = v_newBalance, soldeR = v_soldeR, restantR = v_restantR WHERE id = v_idLigneRecharge AND etatOperation = 'En cours';
         END IF;
     
	INSERT t_reabonner(id, idRespCUR, idDecodeur, montant, dateReabonne) VALUES(0,p_idRespCUR, p_idDecodeur, p_montant, NOW());
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_confirmSaleKitTV` (IN `p_denomination` VARCHAR(250), IN `p_venteK` INT, IN `p_idRespTK` INT, IN `p_idClient` INT)  BEGIN
	DECLARE v_id INT DEFAULT 0;
    DECLARE v_lastSoldeK FLOAT;
    DECLARE v_lastStockRestantK FLOAT;
    DECLARE v_venteK INT;
    DECLARE v_puK INT;
    DECLARE v_stockInitialK INT;
    
	SELECT id INTO v_id FROM t_lignerecharge WHERE stockinitialK <> 0 AND denominationK = p_denomination AND idUtilisateur = p_idRespTK ORDER BY id DESC LIMIT 1;
	SELECT soldeK INTO v_lastSoldeK FROM t_lignerecharge WHERE id = v_id;
    
	SELECT stockRestantK INTO v_lastStockRestantK FROM t_lignerecharge WHERE id = v_id;
    
    SELECT venteK INTO v_venteK FROM t_lignerecharge WHERE id = v_id;
    
    SELECT puK INTO v_puK FROM t_lignerecharge WHERE id = v_id;
    
    SELECT stockinitialK INTO v_stockInitialK FROM t_lignerecharge WHERE id = v_id;
    
    IF v_stockInitialK < v_stockInitialK + p_venteK THEN
    	UPDATE t_lignerecharge SET venteK = v_venteK + p_venteK, soldeK = v_lastSoldeK + (p_venteK * v_puK), stockRestantK = v_lastStockRestantK - p_venteK WHERE id = v_id;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_confirmTransactionE_banking` (IN `p_idTel` INT, IN `p_reseau` VARCHAR(50), IN `p_montant` FLOAT, IN `p_idRespTK` INT, IN `p_operation` VARCHAR(50), IN `p_refTransaction` VARCHAR(30), IN `p_devise` CHAR(4))  BEGIN 
    
    INSERT INTO t_historiquee_banking(id, idRespTK, idTel, montant, devise, dateTransaction, etatTraitement, refTransation) VALUES(0, p_idRespTK, p_idTel, p_montant, p_devise,Now(), 'Not print', p_refTransaction);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_confirmVente` (IN `p_idTel` INT, IN `p_reseau` VARCHAR(50), IN `p_montant` FLOAT, IN `p_idRespCUR` INT, IN `p_operation` VARCHAR(50), IN `p_refVente` VARCHAR(30))  BEGIN 
	DECLARE v_idProduit INT;
    DECLARE v_puProd INT;
    DECLARE v_idRecharge INT;
    DECLARE v_ancienneBalance FLOAT;
    DECLARE v_newBalance FLOAT;
    DECLARE v_approvU FLOAT;
    DECLARE v_pu FLOAT;
    DECLARE v_qteVendu FLOAT;
    DECLARE v_ancienneVente FLOAT;
    DECLARE v_solde FLOAT;
    DECLARE v_reste FLOAT;
    DECLARE v_balance FLOAT;
    DECLARE v_vente FLOAT;
    DECLARE v_taux FLOAT;
    DECLARE v_id INT;
    
    SELECT d.prixUnitaire INTO v_pu FROM t_produit p INNER JOIN t_detailprixproduit d ON p.id = d.idProduit INNER JOIN t_prixproduit pr ON d.idPrix = pr.id INNER JOIN t_lignerecharge l ON p.id = l.idProduit WHERE d.dateDesactivation = '' ORDER BY d.id DESC LIMIT 1;
    
    SELECT id INTO v_idProduit FROM t_produit WHERE designation = 'Unite'; 
    SELECT id INTO v_idRecharge FROM `t_daterecharge` ORDER BY id DESC LIMIT 1;
    SELECT newBallanceU INTO v_ancienneBalance FROM t_lignerecharge WHERE newBallanceU <> 0 AND reseauU = p_reseau ORDER BY id DESC LIMIT 1;
    SELECT approvU INTO v_approvU FROM t_lignerecharge WHERE ballanceU <> 0 AND reseauU = p_reseau ORDER BY id DESC LIMIT 1;
 
 	SELECT l.venteU INTO v_vente FROM t_lignerecharge l WHERE l.newBallanceU <> 0 AND reseauU = p_reseau ORDER BY l.id DESC LIMIT 1;
    SELECT ballanceU INTO v_balance FROM t_lignerecharge l WHERE ballanceU <> 0 AND reseauU = p_reseau ORDER BY id DESC LIMIT 1; 
    
    SELECT montant INTO v_taux FROM t_taux ORDER BY id DESC LIMIT 1;
    
    SELECT id INTO v_id FROM t_lignerecharge WHERE reseauU = p_reseau ORDER BY id DESC LIMIT 1;
    
    SELECT d.prixUnitaire INTO v_puProd FROM `t_produit` p INNER JOIN t_detailprixproduit d ON p.designation = 'Unite' AND d.dateDesactivation = '';
    
    INSERT t_venteunite(id, idRespCUR, idTel, montantCDF, montantEnUnite, dateVente, etatTraitement, refVente) VALUES(0,          p_idRespCUR, p_idTel, p_montant, p_montant/19.2, NOW(), 'Not print', p_refVente);
  
  IF v_ancienneBalance > p_montant/19.2 THEN
    	UPDATE t_lignerecharge SET idProduit = v_idProduit, idDateRecharge = v_idRecharge, idTel = p_idTel, ballanceU = v_balance, newBallanceU = v_ancienneBalance, approvU = v_approvU, reseauU = p_reseau, venteU = (p_montant/19.2) + v_vente, puU = v_pu, soldeU = ((p_montant/19.2) + v_vente) * v_pu, restantU = v_ancienneBalance - ((p_montant/19.2) + v_vente) WHERE id = v_id;
       
  END IF;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_connectUser` (IN `p_codeAgent` VARCHAR(10), IN `p_pwd` VARCHAR(255))  BEGIN
	SELECT * FROM t_utilisateur WHERE codeAgent = p_codeAgent AND pwd = p_pwd AND statut = "Actif";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_createFirstUser` ()  BEGIN
	DECLARE v_numberUsers INT;
    
    SELECT COUNT(*) INTO v_numberUsers FROM t_utilisateur;
    
    IF v_numberUsers = 0 THEN
    	INSERT t_utilisateur(codeAgent, typeUser, categorie, statut,etatConnection, pwd) VALUES('TDKSER-1', 'Responsable CUR', 'Agent', 'Actif','Disconnected', '123456' );
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_createUser` (IN `p_nom` VARCHAR(255), IN `p_tel` VARCHAR(13), IN `p_genre` VARCHAR(1), IN `p_typeUser` VARCHAR(30), IN `p_adresse` VARCHAR(255), IN `p_etatCivil` VARCHAR(50))  BEGIN
DECLARE v_lastId INT;

SELECT id INTO v_lastId FROM t_utilisateur ORDER BY id DESC LIMIT 1;
	INSERT INTO t_utilisateur(id, codeAgent,nom, tel, genre, etatCivil, typeUser, categorie, statut, etatConnection, pwd, adresse) VALUES(0, CONCAT('TDKSER-',v_lastId+1),p_nom, p_tel, p_genre,p_etatCivil, p_typeUser, 'Agent', 'Bloque', 'Disconnected', '123456', p_adresse);
    
    
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllBalanceReabonne` (IN `p_idGerant` INT)  BEGIN
	SELECT l.etatOperation, l.id, l.denominationR, l.ballanceR, l.newBallanceR, d.dateComplet, l.approvR  FROM t_lignerecharge l INNER JOIN t_daterecharge d ON l.idDateRecharge = d.id WHERE l.ballanceR <> 0 AND l.idGerant = p_idGerant AND l.etatOperation = "En cours";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllBalanceUnite` ()  BEGIN
	SELECT l.id, l.reseauU, l.ballanceU, l.newBallanceU, d.dateComplet, l.approvU  FROM t_lignerecharge l INNER JOIN t_daterecharge d ON l.idDateRecharge = d.id WHERE l.ballanceU <> 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllClient` ()  BEGIN
	SELECT * FROM t_utilisateur WHERE typeUser = 'Client' AND categorie = 'Cambiste';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllClientE_banking` ()  BEGIN
	SELECT * FROM t_utilisateur WHERE typeUser = 'Client' AND categorie = 'E-banking';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllClientTelecom` ()  BEGIN
	SELECT * FROM t_utilisateur WHERE t_utilisateur.categorie = "Telecom" AND t_utilisateur.typeUser = "Client";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllCommission` (IN `p_idRespTK` INT)  BEGIN
	SELECT l.beneficeCDF, l.beneficeUSD,l.id, l.etatOperation, l.id, l.reseauCOM, l.commissionInitialeCDF, l.commissionInitialeUSD, d.dateComplet, l.commissionFinaleCDF, l.commissionFinaleUSD, u.nom  FROM t_lignerecharge l INNER JOIN t_daterecharge d ON l.idDateRecharge = d.id INNER JOIN t_utilisateur u ON l.idUtilisateur = u.id WHERE (l.beneficeCDF <> 0 OR l.beneficeUSD <> 0) AND l.idUtilisateur = p_idRespTK AND l.etatOperation = "En cours";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllConfigE_banking` (IN `p_idGerant` INT)  BEGIN 
	SELECT l.approvcdfE, l.approvusdE, l.reseauE, l.id,mt.dateCreatioin,u.nom, mt.montantEnEspere, l.stockinitialusdE, l.stockinitialcdfE, l.newStockcdfE, l.newStockusdE FROM t_lignerecharge l INNER JOIN t_utilisateur u ON l.idUtilisateur = u.id INNER JOIN t_motantespece mt ON l.montantInitialEspeceE = mt.id INNER JOIN t_daterecharge d ON l.idDateRecharge = d.id WHERE stockinitialusdE <> 0 AND l.idGerant = p_idGerant ORDER BY l.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllDateRecharge` ()  BEGIN
	SELECT * FROM t_daterecharge ORDER BY id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllDenomination` (IN `p_idCleint` INT)  BEGIN
	SELECT * FROM t_decodeur WHERE id IN (SELECT id FROM t_decodeur WHERE idClient = p_idCleint);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllDepenses` (IN `p_idGerant` INT)  BEGIN
	SELECT o.id, u.nom, o.typeOperation, o.montantSortieEnCaisse, o.montantRemi, o.raison, o.dateOperation, o.nomDemandeur, o.etatDepense FROM t_operation o INNER JOIN t_utilisateur u ON o.idGerant = u.id WHERE etatDepense = 'En cours' AND idGerant = p_idGerant ORDER BY id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllE_banking` (IN `p_idRespTK` INT)  BEGIN 
	SELECT l.approvcdfE, l.approvusdE,l.approvcdfE, l.reseauE, l.id,mt.dateCreatioin,d.dateComplet,u.nom, mt.montantEnEspere, l.stockinitialusdE, l.stockinitialcdfE, l.newStockcdfE, l.newStockusdE, l.montantCloturecdfE, l.montantClotureusdE, l.sortiecdfE, l.sortieusdE, l.entreecdfE, l.entreeusdE FROM t_lignerecharge l INNER JOIN t_utilisateur u ON l.idUtilisateur = u.id INNER JOIN t_motantespece mt ON l.montantInitialEspeceE = mt.id INNER JOIN t_daterecharge d ON l.idDateRecharge = d.id WHERE stockinitialusdE <> 0 AND l.idUtilisateur = p_idRespTK ORDER BY l.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllHistoriques` ()  BEGIN
	SELECT u.nom, h.montantUSD, h.montantCDF, h.dateHeureChange FROM t_utilisateur u INNER JOIN t_historiquechange h ON u.id = h.idRespCUR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllKit` (IN `p_idGerant` INT)  BEGIN
SELECT l.id, l.idDateRecharge,l.etatOperation, l.id, l.denominationK, l.stockinitialK, l.approvK, d.dateComplet, l.newStockK, l.puK, u.nom  FROM t_lignerecharge l INNER JOIN t_daterecharge d ON l.idDateRecharge = d.id INNER JOIN t_utilisateur u ON l.idUtilisateur = u.id WHERE l.stockinitialK <> 0 AND l.idGerant = p_idGerant AND l.etatOperation = "En cours";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllKitRespTK` (IN `p_idRespTK` INT)  BEGIN
SELECT l.venteK, l.soldeK, l.stockRestantK,l.id, l.idDateRecharge,l.etatOperation, l.id, l.denominationK, l.stockinitialK, l.approvK, d.dateComplet, l.newStockK, l.puK, u.nom  FROM t_lignerecharge l INNER JOIN t_daterecharge d ON l.idDateRecharge = d.id INNER JOIN t_utilisateur u ON l.idUtilisateur = u.id WHERE l.stockinitialK <> 0 AND l.idUtilisateur = p_idRespTK AND l.etatOperation = "En cours";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllMontantAffect` (IN `p_idGerant` INT)  BEGIN
	SELECT p.designation, m.montantEnEspere, a.dateAffectation, u.nom, m.raison FROM t_produit p INNER JOIN t_affectermontantenespece a ON p.id = a.idProduit INNER JOIN t_motantespece m ON a.idMontant = m.id INNER JOIN t_utilisateur u ON a.idRespCUR = u.id WHERE m.idUtilisateur = p_idGerant;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllReseaux` (IN `p_idClient` INT)  BEGIN
	SELECT * FROM t_telephone WHERE id IN (SELECT id FROM t_telephone WHERE idClient = p_idClient);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllSalesUniteNotPrint` ()  BEGIN
	SELECT * FROM t_venteunite v INNER JOIN t_telephone t ON v.idTel = t.id INNER JOIN t_utilisateur u ON v.idRespCUR = u.id WHERE v.etatTraitement = "Not print" ORDER BY v.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllTaux` (IN `p_idGerant` INT)  BEGIN
	SELECT * FROM t_taux WHERE idUtilisateur = p_idGerant;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllUser` ()  BEGIN
	SELECT * FROM t_utilisateur WHERE categorie = 'Agent';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getClientReabonne` ()  BEGIN
	SELECT * FROM t_utilisateur WHERE typeUser = 'Client' AND categorie = 'Telecom';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getDetteForClient` (IN `p_id` INT, IN `p_refDette` INT(30))  NO SQL
BEGIN
select t_utilisateur.nom, t_dette.idClient,t_produit.designation,t_dette.idProduit, t_dette.id, t_dette.dateDette, t_dette.montant, t_dette.note, t_dette.idUtilisateur, t_dette.etatDette, t_dette.reseau, t_dette.idClient, t_dette.refDette from t_dette inner join t_utilisateur on t_dette.idClient = t_Utilisateur.id inner join t_produit on t_produit.id = t_dette.idProduit inner join t_lignerecharge on t_dette.reseau IN (SELECT reseauU FROM t_lignerecharge) where t_utilisateur.typeUser = 'Client' and t_utilisateur.id=t_dette.idClient AND t_produit.etatProduit = 'En vente' AND t_dette.idClient = p_id AND t_dette.refDette = p_refDette AND (t_dette.etatDette = 'En cours' OR t_dette.etatDette = 'Non paye') GROUP BY t_dette.id AND t_dette.refDette ORDER BY t_dette.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getDettePourClient` (IN `p_id` INT, IN `p_refDette` VARCHAR(20))  BEGIN
select t_utilisateur.nom, t_dette.idClient,t_produit.designation,t_dette.idProduit, t_dette.id, t_dette.dateDette, t_dette.montant, t_dette.note, t_dette.idUtilisateur, t_dette.etatDette, t_dette.reseau, t_dette.idClient, t_dette.refDette 
FROM t_dette inner join t_utilisateur on t_dette.idClient = t_Utilisateur.id 
inner join t_produit on t_produit.id = t_dette.idProduit inner join t_lignerecharge on t_dette.reseau 
IN (SELECT reseauU FROM t_lignerecharge) where t_utilisateur.typeUser = 'Client' and t_utilisateur.id=t_dette.idClient AND t_produit.etatProduit = 'En vente' AND t_dette.idClient = p_id AND t_dette.refDette = p_refDette AND t_dette.etatDette <> 'Paye' GROUP BY t_dette.id ORDER BY t_dette.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getHistoriqueChange` ()  BEGIN
	SELECT h.montantUSD, h.montantCDF, h.dateHeureChange, u.nom FROM t_historiquechange h INNER JOIN t_utilisateur u ON h.idRespCUR = u.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getHistoryOfSalesUnite` ()  BEGIN
	SELECT u.nom, v.montantCDF, t.tel, v.montantEnUnite, v.dateVente, v.etatTraitement FROM t_utilisateur u INNER JOIN t_venteunite v ON u.id = v.idRespCUR INNER JOIN t_telephone t ON v.idTel = t.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getHistoryReabonnement` ()  BEGIN
	SELECT u.nom, r.montant, r.dateReabonne, d.codeDecodeur FROM t_utilisateur u INNER JOIN t_reabonner r ON u.id = r.idRespCUR INNER JOIN t_decodeur d ON r.idDecodeur = d.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getInvoiceSaleUnite` (IN `p_idRespCUR` INT)  BEGIN
	SELECT * FROM t_venteunite v INNER JOIN t_telephone t ON v.idTel = t.id  WHERE v.etatTraitement = "Not print" AND v.idRespCUR = p_idRespCUR;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getLastIdSaleUnite` ()  BEGIN
	SELECT id FROM t_venteunite ORDER BY id DESC LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getLastMontantInitialEnEspece` ()  BEGIN
    SELECT m.id, m.montantEnEspere FROM t_utilisateur u INNER JOIN t_affectermontantenespece a ON u.id = a.idRespCUR INNER JOIN t_motantespece m ON a.idMontant = m.id ORDER BY m.id DESC LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getLastTaux` ()  NO SQL
BEGIN
SELECT montant FROM t_taux order by id desc limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getPayeDette` ()  NO SQL
BEGIN
select t_utilisateur.nom, t_produit.designation,  t_dette.id, t_dette.dateDette, t_dette.montant, t_dette.note, t_dette.idUtilisateur, t_dette.refDette, t_dette.etatDette, t_dette.reseau, t_dette.idClient
from t_dette inner join t_utilisateur on t_dette.idClient = t_Utilisateur.id inner join t_produit on t_produit.id = t_dette.idProduit inner join t_lignerecharge on t_dette.reseau IN (SELECT reseauU FROM t_lignerecharge)
where t_utilisateur.typeUser = 'Client' and t_dette.etatDette = 'Non paye'  GROUP BY t_dette.id ORDER BY t_dette.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getReport` (IN `p_idUtilisateur` INT)  BEGIN
	SELECT l.capitalC, u.nom, l.changeC, l.tauxC, l.resteC, l.id, d.dateComplet FROM t_lignerecharge l INNER JOIN 	 t_utilisateur u ON l.idUtilisateur = u.id INNER JOIN t_daterecharge d ON l.idDateRecharge = (SELECT id FROM t_daterecharge ORDER BY id DESC LIMIT 1) WHERE l.idUtilisateur = p_idUtilisateur AND l.capitalC <> 0 GROUP BY l.capitalC ORDER BY l.id ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getRepportReabonnement` (IN `p_id` INT)  BEGIN
	SELECT l.approvR, l.denominationR,  u.nom, l.ballanceR, l.newBallanceR, l.soldeR, l.id, d.dateComplet, l.restantR FROM t_lignerecharge l INNER JOIN t_utilisateur u ON l.idUtilisateur = u.id INNER JOIN t_daterecharge d ON l.idDateRecharge = (SELECT id FROM t_daterecharge ORDER BY id DESC LIMIT 1) WHERE l.idUtilisateur = p_id AND l.ballanceR <> 0 GROUP BY l.denominationR ORDER BY l.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_reconfigurerCompte` (IN `p_id` INT, IN `p_nom` VARCHAR(255), IN `p_tel` VARCHAR(14), IN `p_adresse` VARCHAR(255), IN `p_etatCivil` VARCHAR(15), IN `p_genre` CHAR(1))  BEGIN
	UPDATE t_utilisateur SET nom = p_nom, tel = p_tel, adresse = p_adresse, etatCivil = p_etatCivil, genre = p_genre WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_reportVenteUnite` (IN `p_idUser` INT)  BEGIN
	SELECT d.dateComplet, l.reseauU, l.ballanceU, l.approvU, l.newBallanceU, l.venteU, l.puU, l.soldeU, l.restantU FROM t_lignerecharge l INNER JOIN t_utilisateur u ON l.idUtilisateur = u.id INNER JOIN t_daterecharge d ON l.idDateRecharge = (SELECT id FROM t_daterecharge ORDER BY id DESC LIMIT 1) WHERE l.idUtilisateur = p_idUser AND l.ballanceU <> 0 GROUP BY l.ballanceU, l.reseauU ORDER BY l.id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_saveCapitalChange` (IN `p_CapitalC` FLOAT, IN `p_idDateRecharge` INT, IN `p_tauxC` FLOAT, IN `p_changeC` FLOAT, IN `p_resteC` FLOAT, IN `p_idRespCUR` INT)  NO SQL
BEGIN
	
    DECLARE v_taux FLOAT;
    DECLARE v_date FLOAT;
    
	SELECT montant into v_taux from  t_taux order by id DESC LIMIT 1;
    SELECT id into v_date from t_daterecharge where id <> 0 order by id 	desc LIMIT 1;
	INSERT into t_lignerecharge(id, idDateRecharge, idUtilisateur, capitalC, changeC, tauxC, resteC) values (0, v_date,p_idRespCUR, p_CapitalC, 0, v_taux, p_CapitalC);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_saveClient` (IN `p_nom` VARCHAR(255), IN `p_tel` VARCHAR(14), IN `p_genre` VARCHAR(1), IN `p_categorie` VARCHAR(255), IN `p_adresse` VARCHAR(255))  BEGIN INSERT t_utilisateur(id, codeAgent, nom, tel, genre, etatCivil, typeUser, categorie, statut, etatConnection, pwd, adresse) VALUES(0, '', p_nom, p_tel, p_genre, '', 'Client',p_categorie, '', '', '', p_adresse); END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_saveHistoriqueChange` (IN `p_idRespCUR` INT, IN `p_montantUSD` FLOAT, IN `p_montantCDF` FLOAT)  NO SQL
BEGIN

DECLARE v_capital FLOAT;
DECLARE v_reste FLOAT;
DECLARE v_change FLOAT;
DECLARE v_verifyReste FLOAT;
DECLARE v_idLigneRecharge INT;

INSERT into t_historiquechange (id, idRespCUR, montantUSD, montantCDF, dateHeureChange) values (0, p_idRespCUR, p_montantUSD, p_montantCDF, NOW());

SELECT id INTO v_idLigneRecharge FROM t_lignerecharge WHERE capitalC <> 0 order by id desc LIMIT 1;

SELECT capitalC INTO v_capital FROM t_lignerecharge where capitalC <> 0 order by id DESC LIMIT 1;

SELECT changeC+p_montantUSD INTO v_change FROM t_lignerecharge WHERE capitalC <> 0 order by id desc LIMIT 1;

SELECT resteC-p_montantCDF INTO v_reste FROM t_lignerecharge WHERE capitalC <> 0 order by id desc LIMIT 1;

SELECT resteC INTO v_verifyReste FROM t_lignerecharge WHERE capitalC <> 0 order by id desc LIMIT 1;

IF v_verifyReste >= p_montantCDF THEN

	UPDATE t_lignerecharge SET t_lignerecharge.changeC = v_change, t_lignerecharge.resteC = v_reste WHERE t_lignerecharge.id = v_idLigneRecharge;

END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_saveSaleToDette` (IN `p_idClient` INT, IN `p_montant` FLOAT, IN `p_idUtilisateur` INT, IN `p_reseau` VARCHAR(50))  BEGIN
	DECLARE v_idProduit INT;
    DECLARE v_idDetteAncien INT DEFAULT 1;
    DECLARE v_countTableContent INT;
    
    SELECT COUNT(*) INTO v_countTableContent FROM t_dette LIMIT 1;
    SELECT id INTO v_idProduit FROM t_produit WHERE t_produit.designation = 'Unite' LIMIT 1;
    IF v_countTableContent <> 0 THEN
    	SELECT id INTO v_idDetteAncien FROM t_dette ORDER BY id DESC LIMIT 1;
    END IF;
    
	INSERT t_dette(id, idProduit, idClient, montant, dateDette, etatDette, idUtilisateur, note, reseau, refDette) VALUES(0, v_idProduit, p_idClient, p_montant, NOW(), 'Non paye', p_idUtilisateur, "Suite a manque, le client a pris une dette chez TDK Services", p_reseau, CONCAT('Ref/dette/','-',v_idDetteAncien + 1));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_signalerDepense` (IN `p_typeDepense` VARCHAR(200), IN `p_montantSortieEnCaisse` FLOAT, IN `p_raison` TEXT, IN `p_nomDemandeur` VARCHAR(255), IN `p_idGerant` INT)  BEGIN
	INSERT INTO t_operation(id, typeOperation, montantSortieEnCaisse, montantRemi, raison, dateOperation, nomDemandeur, idGerant, etatDepense) VALUES(0, p_typeDepense, p_montantSortieEnCaisse, 0, p_raison, NOW(), p_nomDemandeur, p_idGerant, 'En cours');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_signalerPayeDepense` (IN `p_idDepense` INT)  BEGIN
	DECLARE v_lastMontantSortieCaisse FLOAT DEFAULT 0;
    
    SELECT montantSortieEnCaisse INTO v_lastMontantSortieCaisse FROM t_operation WHERE id = p_idDepense;
    
    UPDATE t_operation SET montantRemi = v_lastMontantSortieCaisse, etatDepense = 'Epurer' WHERE id = p_idDepense;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_treatDette` (IN `p_idProduit` INT, IN `p_idClient` INT, IN `p_montant` FLOAT, IN `p_idUtilisateur` INT, IN `p_reseau` VARCHAR(50), IN `p_refDette` VARCHAR(20))  BEGIN
	DECLARE v_sumDetteAvancees FLOAT;
    DECLARE v_montantDetteInitial FLOAT;
   
    
	SELECT  SUM(montant) + p_montant INTO v_sumDetteAvancees FROM t_dette WHERE refDette = p_refDette AND etatDette <> 'Non paye';

    SELECT  montant INTO v_montantDetteInitial FROM t_dette WHERE refDette = p_refDette AND etatDette = 'Non paye';
     
     IF v_sumDetteAvancees >= v_montantDetteInitial THEN
       	INSERT t_dette(id, idProduit, idClient, montant, dateDette, etatDette, idUtilisateur, note,    		reseau, refDette) VALUES(0, p_idProduit, p_idClient, p_montant, NOW(), 'Paye',p_idUtilisateur, 'Le client epure sa dette', p_reseau, p_refDette); 
     UPDATE t_dette SET t_dette.etatDette = 'Paye' WHERE t_dette.refDette = p_refDette AND t_dette.etatDette = 'Non paye';
     ELSE 
		INSERT t_dette(id, idProduit, idClient, montant, dateDette, etatDette, idUtilisateur, note,    		reseau, refDette) VALUES(0, p_idProduit, p_idClient, p_montant, NOW(), 'En cours',p_idUtilisateur, 'Le client avance  sa dette', p_reseau, p_refDette);
     END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_updateConnectionState` (IN `p_codeAgent` VARCHAR(20), IN `p_pwd` VARCHAR(255))  BEGIN
	DECLARE v_currentConnectionState VARCHAR(50) DEFAULT '';
    
    SELECT etatConnection INTO v_currentConnectionState FROM t_utilisateur WHERE codeAgent = p_codeAgent AND pwd = p_pwd;
	IF v_currentConnectionState = 'Disconnected' THEN
		UPDATE t_utilisateur SET etatConnection = 'Connected' WHERE codeAgent = p_codeAgent AND pwd = p_pwd;
    ELSE
    	UPDATE t_utilisateur SET etatConnection = 'Disconnected' WHERE codeAgent = p_codeAgent AND pwd = p_pwd;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_updatePwd` (IN `p_pwd` VARCHAR(255), IN `p_codeAgent` VARCHAR(10))  BEGIN UPDATE t_utilisateur SET pwd = p_pwd WHERE codeAgent = p_codeAgent; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_updateStatePrint` (IN `p_numSale` VARCHAR(30))  BEGIN
	UPDATE t_venteunite SET etatTraitement = 'Print' WHERE refVente = p_numSale;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_updateUserAccount` (IN `p_idUser` INT)  BEGIN
DECLARE v_currentStatusAccount VARCHAR(20) DEFAULT '';

SELECT statut INTO v_currentStatusAccount FROM t_utilisateur WHERE id = p_idUser;
    IF v_currentStatusAccount = 'Actif' THEN
		UPDATE t_utilisateur SET statut = 'Bloque' WHERE id = p_idUser;
    ELSE
    	UPDATE t_utilisateur SET statut = 'Actif' WHERE id = p_idUser;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_affectermontantenespece`
--

CREATE TABLE `t_affectermontantenespece` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idMontant` int(11) NOT NULL,
  `dateAffectation` varchar(30) NOT NULL,
  `idRespCUR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_affectermontantenespece`
--

INSERT INTO `t_affectermontantenespece` (`id`, `idProduit`, `idMontant`, `dateAffectation`, `idRespCUR`) VALUES
(1, 1, 1, '2022-01-21', 1),
(2, 3, 14, '2022-01-21', 1),
(3, 3, 15, '2022-01-21', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_daterecharge`
--

CREATE TABLE `t_daterecharge` (
  `id` int(11) NOT NULL,
  `jour` int(11) NOT NULL,
  `mois` enum('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre','') NOT NULL,
  `annee` int(11) NOT NULL,
  `heure` varchar(8) NOT NULL,
  `dateComplet` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_daterecharge`
--

INSERT INTO `t_daterecharge` (`id`, `jour`, `mois`, `annee`, `heure`, `dateComplet`) VALUES
(1, 12, 'Juin', 2020, '12h30', '12/06/2020'),
(2, 23, 'Avril', 2021, '13h28', '23/04/2021'),
(3, 1, 'Fevrier', 2022, '17:25', '2022-01-26 15:45:00'),
(4, 4, 'Juin', 2022, '17:48', '2022-01-26 15:46:16'),
(5, 4, 'Mars', 2022, '19:47', '2022-01-26 15:47:21');

-- --------------------------------------------------------

--
-- Structure de la table `t_decodeur`
--

CREATE TABLE `t_decodeur` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idRespCUR` int(11) NOT NULL,
  `codeDecodeur` varchar(50) NOT NULL,
  `denomination` enum('StarTimes','Easy TV','Canal +') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_decodeur`
--

INSERT INTO `t_decodeur` (`id`, `idClient`, `idRespCUR`, `codeDecodeur`, `denomination`) VALUES
(1, 4, 1, '09837453273230', 'StarTimes'),
(2, 4, 1, '09843943732345', 'Canal +'),
(3, 4, 1, '00423895700356', 'Easy TV'),
(4, 6, 1, '89424092000326', 'Canal +');

-- --------------------------------------------------------

--
-- Structure de la table `t_detailprixproduit`
--

CREATE TABLE `t_detailprixproduit` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idPrix` int(11) NOT NULL,
  `prixUnitaire` float NOT NULL,
  `dateCreation` varchar(20) NOT NULL,
  `dateDesactivation` varchar(25) NOT NULL,
  `idGerant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_detailprixproduit`
--

INSERT INTO `t_detailprixproduit` (`id`, `idProduit`, `idPrix`, `prixUnitaire`, `dateCreation`, `dateDesactivation`, `idGerant`) VALUES
(1, 1, 2, 20, '11/01/2022', '22/01/2022', 1),
(2, 1, 1, 19.2, '22/01/2022', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_dette`
--

CREATE TABLE `t_dette` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `dateDette` varchar(25) NOT NULL,
  `etatDette` enum('Paye','Non paye','En cours') NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `note` text NOT NULL,
  `reseau` enum('','VodaCom','Airtel','Orange','Africell') NOT NULL,
  `refDette` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_dette`
--

INSERT INTO `t_dette` (`id`, `idProduit`, `idClient`, `montant`, `dateDette`, `etatDette`, `idUtilisateur`, `note`, `reseau`, `refDette`) VALUES
(2, 1, 3, 19200, '2022-01-27 17:26:55', 'Paye', 1, 'Suite a manque, le client a pris une dette chez TDK Services', 'Airtel', 'Ref/dette/-2'),
(3, 1, 3, 19000, '2022-01-27 17:28:12', 'En cours', 1, 'Le client avance  sa dette', 'Airtel', 'Ref/dette/-2'),
(4, 1, 3, 200, '2022-01-27 17:28:55', 'Paye', 1, 'Le client epure sa dette', 'Airtel', 'Ref/dette/-2');

-- --------------------------------------------------------

--
-- Structure de la table `t_historiqueapprove_banking`
--

CREATE TABLE `t_historiqueapprove_banking` (
  `id` int(11) NOT NULL,
  `idGerant` int(11) NOT NULL,
  `montantApprov` int(11) NOT NULL,
  `devise` enum('USD','CDF') NOT NULL,
  `idDateApprov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_historiqueapprove_banking`
--

INSERT INTO `t_historiqueapprove_banking` (`id`, `idGerant`, `montantApprov`, `devise`, `idDateApprov`) VALUES
(1, 5, 5, 'USD', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_historiquechange`
--

CREATE TABLE `t_historiquechange` (
  `id` int(11) NOT NULL,
  `idRespCUR` int(11) NOT NULL,
  `montantUSD` float NOT NULL,
  `montantCDF` float NOT NULL,
  `dateHeureChange` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_historiquechange`
--

INSERT INTO `t_historiquechange` (`id`, `idRespCUR`, `montantUSD`, `montantCDF`, `dateHeureChange`) VALUES
(1, 1, 20, 39000, '2022-01-27 12:04:04'),
(2, 1, 200, 400000, '2022-01-27 17:38:20'),
(3, 1, 300, 600000, '2022-01-27 17:40:41'),
(4, 1, 140, 280000, '2022-01-27 17:41:28');

-- --------------------------------------------------------

--
-- Structure de la table `t_historiquee_banking`
--

CREATE TABLE `t_historiquee_banking` (
  `id` int(11) NOT NULL,
  `idRespTK` int(11) NOT NULL,
  `idTel` int(11) NOT NULL,
  `montant` float NOT NULL,
  `devise` enum('USD','CDF') NOT NULL,
  `dateTransaction` varchar(50) NOT NULL,
  `etatTraitement` enum('Print','Not print') NOT NULL,
  `refTransation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_historiquee_banking`
--

INSERT INTO `t_historiquee_banking` (`id`, `idRespTK`, `idTel`, `montant`, `devise`, `dateTransaction`, `etatTraitement`, `refTransation`) VALUES
(1, 12, 6, 10, 'USD', '2022-02-15 15:38:01', 'Not print', 'FTDKS2022021522');

-- --------------------------------------------------------

--
-- Structure de la table `t_lignerecharge`
--

CREATE TABLE `t_lignerecharge` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idDateRecharge` int(11) NOT NULL,
  `idTel` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idGerant` int(11) NOT NULL,
  `etatOperation` enum('En cours','Archive','Close') NOT NULL,
  `reseauE` enum('','Orange Money','Pepele Mobil','M-Pesa','Airtel Money') NOT NULL,
  `montantInitialEspeceE` int(11) NOT NULL,
  `stockinitialusdE` float NOT NULL,
  `stockinitialcdfE` float NOT NULL,
  `approvcdfE` float NOT NULL,
  `approvusdE` float NOT NULL,
  `newStockcdfE` float NOT NULL,
  `newStockusdE` float NOT NULL,
  `montantCloturecdfE` float NOT NULL,
  `montantClotureusdE` float NOT NULL,
  `entreecdfE` float NOT NULL,
  `entreeusdE` float NOT NULL,
  `sortiecdfE` float NOT NULL,
  `sortieusdE` float NOT NULL,
  `denominationR` enum('','Canal +','Easy TV','StarTimes') NOT NULL,
  `ballanceR` float NOT NULL,
  `approvR` float NOT NULL,
  `newBallanceR` float NOT NULL,
  `soldeR` float NOT NULL,
  `restantR` float NOT NULL,
  `denominationK` enum('','Decodeur EasyTv','Canal+','Kit complet','Antenne','Chargeur','Decodeur StarTimes') NOT NULL,
  `stockinitialK` float NOT NULL,
  `approvK` float NOT NULL,
  `newStockK` float NOT NULL,
  `venteK` float NOT NULL,
  `puK` float NOT NULL,
  `soldeK` float NOT NULL,
  `stockRestantK` float NOT NULL,
  `reseauU` enum('','Orange','VodaCom','Africell','Airtel') NOT NULL,
  `ballanceU` float NOT NULL,
  `approvU` float NOT NULL,
  `newBallanceU` float NOT NULL,
  `venteU` float NOT NULL,
  `puU` float NOT NULL,
  `soldeU` float NOT NULL,
  `restantU` float NOT NULL,
  `capitalC` float NOT NULL,
  `changeC` float NOT NULL,
  `tauxC` float NOT NULL,
  `resteC` float NOT NULL,
  `reseauCOM` enum('','M-Pesa','Orange money','Pepele mobile','Airtel money') NOT NULL,
  `commissionInitialeCDF` double NOT NULL,
  `commissionInitialeUSD` double NOT NULL,
  `commissionFinaleCDF` double NOT NULL,
  `commissionFinaleUSD` double NOT NULL,
  `beneficeCDF` double NOT NULL,
  `beneficeUSD` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_lignerecharge`
--

INSERT INTO `t_lignerecharge` (`id`, `idProduit`, `idDateRecharge`, `idTel`, `idUtilisateur`, `idGerant`, `etatOperation`, `reseauE`, `montantInitialEspeceE`, `stockinitialusdE`, `stockinitialcdfE`, `approvcdfE`, `approvusdE`, `newStockcdfE`, `newStockusdE`, `montantCloturecdfE`, `montantClotureusdE`, `entreecdfE`, `entreeusdE`, `sortiecdfE`, `sortieusdE`, `denominationR`, `ballanceR`, `approvR`, `newBallanceR`, `soldeR`, `restantR`, `denominationK`, `stockinitialK`, `approvK`, `newStockK`, `venteK`, `puK`, `soldeK`, `stockRestantK`, `reseauU`, `ballanceU`, `approvU`, `newBallanceU`, `venteU`, `puU`, `soldeU`, `restantU`, `capitalC`, `changeC`, `tauxC`, `resteC`, `reseauCOM`, `commissionInitialeCDF`, `commissionInitialeUSD`, `commissionFinaleCDF`, `commissionFinaleUSD`, `beneficeCDF`, `beneficeUSD`) VALUES
(1, 1, 5, 3, 1, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 57106, 106400, 163506, 2000, 19.2, 38400, 161506, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(3, 1, 5, 2, 1, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 48869, 0, 48869, 2500, 19.2, 48000, 46369, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(4, 1, 5, 4, 1, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Africell', 1639, 21280, 22919, 322.917, 19.2, 6200, 22596.1, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(5, 2, 5, 0, 1, 5, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'StarTimes', 559680, 0, 559680, 0, 559680, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(6, 1, 5, 3, 1, 5, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Easy TV', 993200, 0, 993200, 0, 993200, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(9, 1, 5, 5, 1, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Orange', 57966, 0, 57966, 34854.2, 19.2, 669200, 23111.8, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(10, 2, 5, 0, 1, 5, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Canal +', 832000, 0, 832000, 20000, 812000, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(11, 0, 5, 0, 1, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 0, 0, 0, 0, 1000000, 500, 2000, 0, '', 0, 0, 0, 0, 0, 0),
(12, 1, 5, 1, 1, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 57106, 106400, 163506, 4000, 19.2, 76800, 159506, 500000, 140, 2000, 220000, '', 0, 0, 0, 0, 0, 0),
(13, 3, 5, 0, 12, 5, 'Close', 'Airtel Money', 19317500, 85, 21424500, 0, 0, 21424500, 85, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(14, 3, 5, 0, 12, 5, 'Close', 'Orange Money', 15, 32, 345678, 0, 8, 345678, 40, 15722500, 335, 15376800, 295, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 2000, 0, '', 0, 0, 0, 0, 0, 0),
(21, 3, 5, 0, 12, 5, 'En cours', 'Orange Money', 15966837, 335, 15722500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(22, 4, 5, 0, 12, 5, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'Canal+', 10, 5, 15, 5, 1500, 7500, 10, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(27, 5, 5, 0, 12, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 647312.6875, 103.06809997558594, 665141.4375, 107.90809631347656, 17828.75, 4.840000152587891),
(28, 5, 5, 0, 12, 0, 'En cours', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'M-Pesa', 24.9689998626709, 5.809999942779541, 29.322999954223633, 7.079999923706055, 4.354000091552734, 1.2699999809265137);

-- --------------------------------------------------------

--
-- Structure de la table `t_motantespece`
--

CREATE TABLE `t_motantespece` (
  `id` int(11) NOT NULL,
  `montantEnEspere` float NOT NULL,
  `dateCreatioin` varchar(25) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `devise` enum('CDF','USD') NOT NULL,
  `raison` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_motantespece`
--

INSERT INTO `t_motantespece` (`id`, `montantEnEspere`, `dateCreatioin`, `idUtilisateur`, `devise`, `raison`) VALUES
(1, 1000000, '2022-02-06 14:41:49', 5, 'CDF', 'Je viens de liberer 1000000 CDF'),
(2, 1000000, '2022-02-06 14:43:43', 5, 'CDF', 'Je viens de liberer 1000000 CDF'),
(3, 1000000, '2022-02-06 14:57:37', 5, 'CDF', 'Je viens de liberer 1000000 CDF'),
(4, 1000000, '2022-02-06 14:57:50', 5, 'CDF', 'Je viens de liberer 1000000 CDF'),
(5, 1000000, '2022-02-06 14:59:20', 5, 'CDF', 'Je viens de liberer 1000000 CDF'),
(6, 1000000, '2022-02-06 15:00:07', 5, 'CDF', 'Je viens de liberer 1000000 CDF'),
(7, 1500000, '2022-02-06 15:48:04', 5, 'CDF', 'Je t\'ajoute ceci'),
(8, 1500000, '2022-02-06 15:49:19', 5, 'CDF', 'Je t\'ajoute ceci'),
(9, 1500000, '2022-02-06 15:50:10', 5, 'CDF', 'Je t\'ajoute ceci'),
(10, 1500000, '2022-02-06 15:51:20', 5, 'CDF', 'Je t\'ajoute ceci'),
(11, 1500000, '2022-02-06 15:52:04', 5, 'CDF', 'Je t\'ajoute ceci'),
(12, 1500000, '2022-02-06 15:52:07', 5, 'CDF', 'Je t\'ajoute ceci'),
(13, 1500000, '2022-02-06 15:56:30', 5, 'CDF', 'sdfg'),
(14, 1500000, '2022-02-06 16:01:34', 5, 'CDF', 'sdfg'),
(15, 1400000, '2022-02-06 16:02:02', 5, 'CDF', 'sdfg');

-- --------------------------------------------------------

--
-- Structure de la table `t_operation`
--

CREATE TABLE `t_operation` (
  `id` int(11) NOT NULL,
  `typeOperation` enum('Retrait achat','Retrait depense','Retrait Taxes et Import') NOT NULL,
  `montantSortieEnCaisse` float NOT NULL,
  `montantRemi` float NOT NULL,
  `raison` text NOT NULL,
  `dateOperation` varchar(15) NOT NULL,
  `nomDemandeur` varchar(255) NOT NULL,
  `idGerant` int(11) NOT NULL,
  `etatDepense` enum('En cours','Epurer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_operation`
--

INSERT INTO `t_operation` (`id`, `typeOperation`, `montantSortieEnCaisse`, `montantRemi`, `raison`, `dateOperation`, `nomDemandeur`, `idGerant`, `etatDepense`) VALUES
(2, 'Retrait achat', 10000, 0, 'Je sors 10000 CFD pour raison ...', '2022-02-20 09:4', 'Theo', 5, 'En cours'),
(3, 'Retrait achat', 10000, 10000, 'Je sors 10000 CFD pour raison ...', '2022-02-20 09:4', 'Theo', 5, 'Epurer');

-- --------------------------------------------------------

--
-- Structure de la table `t_organisation`
--

CREATE TABLE `t_organisation` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `secteur` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `codeOrganisation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_prixproduit`
--

CREATE TABLE `t_prixproduit` (
  `id` int(11) NOT NULL,
  `devise` enum('CDF','USD') NOT NULL,
  `dateCreation` varchar(25) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_prixproduit`
--

INSERT INTO `t_prixproduit` (`id`, `devise`, `dateCreation`, `idUtilisateur`) VALUES
(1, 'CDF', '11/01/2022', 1),
(2, 'CDF', '22/01/2022', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_produit`
--

CREATE TABLE `t_produit` (
  `id` int(11) NOT NULL,
  `designation` enum('Kit','Argent','Unite','Reabonnement','E-banking','Commission') NOT NULL,
  `typeProduit` enum('Produit virtuel','Produit materiel') NOT NULL,
  `etatProduit` enum('En vente','Archiver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_produit`
--

INSERT INTO `t_produit` (`id`, `designation`, `typeProduit`, `etatProduit`) VALUES
(1, 'Unite', 'Produit virtuel', 'En vente'),
(2, 'Reabonnement', 'Produit virtuel', 'En vente'),
(3, 'E-banking', 'Produit virtuel', 'En vente'),
(4, 'Kit', 'Produit materiel', 'En vente'),
(5, 'Commission', 'Produit virtuel', 'En vente');

-- --------------------------------------------------------

--
-- Structure de la table `t_reabonner`
--

CREATE TABLE `t_reabonner` (
  `id` int(11) NOT NULL,
  `idRespCUR` int(11) NOT NULL,
  `idDecodeur` int(11) NOT NULL,
  `montant` float NOT NULL,
  `dateReabonne` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_reabonner`
--

INSERT INTO `t_reabonner` (`id`, `idRespCUR`, `idDecodeur`, `montant`, `dateReabonne`) VALUES
(1, 1, 1, 10000, '2022-01-27 11:00:00'),
(2, 1, 2, 10000, '2022-01-27 11:02:55'),
(3, 1, 2, 10000, '2022-01-27 11:12:19'),
(4, 1, 3, 5000, '2022-01-27 11:18:44'),
(5, 1, 2, 5000, '2022-01-27 11:21:54'),
(6, 1, 3, 5000, '2022-01-27 11:22:18'),
(7, 1, 1, 5000, '2022-01-27 11:23:05'),
(8, 1, 1, 5000, '2022-01-27 11:25:42'),
(9, 1, 4, 20000, '2022-01-27 17:35:40');

-- --------------------------------------------------------

--
-- Structure de la table `t_taux`
--

CREATE TABLE `t_taux` (
  `id` int(11) NOT NULL,
  `montant` float NOT NULL,
  `dateCreation` varchar(25) NOT NULL,
  `dateTauxJour` varchar(25) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_taux`
--

INSERT INTO `t_taux` (`id`, `montant`, `dateCreation`, `dateTauxJour`, `idUtilisateur`) VALUES
(1, 2005, '17/01/2022', '17/01/2022', 5),
(2, 2010, '16/01/2022', '17/01/2022', 5),
(3, 2000, '18/09/2021', '17/01/2022', 5),
(4, 1950, '2022-01-26 14:39:03', '2022-01-26', 5),
(5, 2000, '2022-01-27 17:37:38', '2022-01-27', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_telephone`
--

CREATE TABLE `t_telephone` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idRespCUR` int(11) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `reseau` enum('Airtel','VodaCom','Africell','Orange') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_telephone`
--

INSERT INTO `t_telephone` (`id`, `idClient`, `idRespCUR`, `tel`, `reseau`) VALUES
(1, 2, 1, '+243972580358', 'Airtel'),
(2, 2, 1, '+243 81087637', 'VodaCom'),
(3, 3, 1, '+243974675273', 'Airtel'),
(4, 3, 1, '+243900659832', 'Africell'),
(5, 3, 1, '+243894578763', 'Orange'),
(6, 16, 12, '+243 90876376', 'Airtel');

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

CREATE TABLE `t_utilisateur` (
  `id` int(11) NOT NULL,
  `codeAgent` varchar(10) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `genre` enum('F','M') NOT NULL,
  `etatCivil` enum('Celibataire','Marie','Veuf','Veuve') NOT NULL,
  `typeUser` enum('Secretaire','Gerant','Responsable CUR','Responsable TK','Chef','Client','Admin') NOT NULL,
  `categorie` enum('Agent','Telecom','Cambiste','E-banking') NOT NULL,
  `statut` enum('Actif','Bloque','') NOT NULL,
  `etatConnection` enum('Connected','Disconnected','') NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`id`, `codeAgent`, `nom`, `tel`, `genre`, `etatCivil`, `typeUser`, `categorie`, `statut`, `etatConnection`, `pwd`, `adresse`) VALUES
(1, 'TDKSER-1', 'Jonathan DIMOKE', '+243972580358', 'M', 'Celibataire', 'Responsable CUR', 'Agent', 'Actif', 'Disconnected', '123456', '03, Av.Ngokaf, Q.Kalubwe, C. Lubumbashi'),
(2, '', 'Simplice MWEMBO', '+243972580358', 'M', '', 'Client', 'Cambiste', '', '', '', '03, Av.Ngokaf, Q.Kalubwe, C. Lubumbashi'),
(3, '', 'Theo', '+243973044263', 'M', '', 'Client', 'Cambiste', '', '', '', 'Katanga'),
(4, '', 'Jaelle', '+243897348573', 'F', '', 'Client', 'Telecom', '', '', '', 'Lushi'),
(5, 'TDKSER-2', 'Gedeon', '+243 9087637', 'M', 'Celibataire', 'Gerant', 'Agent', 'Actif', 'Disconnected', '123456', '03, Av.Ngokaf, Q.Kalubwe, C. Lubumbashi'),
(6, '', 'Chad', '+243972580358', 'M', '', 'Client', 'Telecom', '', '', '', 'uuuuuuu'),
(7, '', 'Ousmane ILUNGA', '+243972580358', 'M', '', 'Responsable TK', 'Agent', 'Bloque', 'Disconnected', '', '03, Av.Ngokaf, Q.Kalubwe, C. Lubumbashi'),
(12, 'TDKSER-8', 'Jaelle', '+243972580358', 'F', 'Celibataire', 'Responsable TK', 'Agent', 'Actif', 'Connected', '123456', '03, Av.Ngokaf, Q.Kalubwe, C. Lubumbashi'),
(13, '', 'Mbaya', '+243 81087637', 'M', '', 'Client', 'Cambiste', '', '', '', 'Lubumbashi'),
(14, '', 'Dominique MUNDALA', '+243 90876374', 'M', '', 'Client', 'Cambiste', '', '', '', 'Katanga'),
(15, '', 'Dorcas MWEMBO', '+243820984733', 'F', '', 'Client', 'Cambiste', '', '', '', 'Katanga'),
(16, '', 'Jonathan KITENGIE', '+243972580837', 'M', '', 'Client', 'E-banking', '', '', '', '03, Av.Ngokaf, Q.Kalubwe, C. Lubumbashi');

-- --------------------------------------------------------

--
-- Structure de la table `t_venteunite`
--

CREATE TABLE `t_venteunite` (
  `id` int(11) NOT NULL,
  `idRespCUR` int(11) NOT NULL,
  `idTel` int(11) NOT NULL,
  `montantCDF` float NOT NULL,
  `montantEnUnite` float NOT NULL,
  `dateVente` varchar(30) NOT NULL,
  `etatTraitement` enum('Print','Not print') NOT NULL,
  `refVente` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_venteunite`
--

INSERT INTO `t_venteunite` (`id`, `idRespCUR`, `idTel`, `montantCDF`, `montantEnUnite`, `dateVente`, `etatTraitement`, `refVente`) VALUES
(1, 1, 3, 19200, 1010.53, '2022-01-27 16:28:31', 'Print', 'FTDKS-1'),
(2, 1, 3, 19200, 1000, '2022-01-27 16:33:03', 'Print', 'FTDKS-2'),
(3, 1, 3, 19200, 1000, '2022-01-27 16:44:25', 'Print', 'FTDKS-3'),
(4, 1, 3, 19200, 1000, '2022-01-27 16:46:29', 'Print', 'FTDKS-4'),
(5, 1, 2, 9600, 500, '2022-01-27 16:48:33', 'Print', 'FTDKS-5'),
(6, 1, 2, 9600, 500, '2022-01-27 16:52:01', 'Print', 'FTDKS-6'),
(7, 1, 4, 6200, 322.917, '2022-01-27 16:55:21', 'Print', 'FTDKS-7'),
(8, 1, 5, 669200, 34854.2, '2022-01-27 16:58:32', 'Print', 'FTDKS-8'),
(9, 1, 5, 19200, 1000, '2022-01-27 17:02:38', 'Print', 'FTDKS-9'),
(10, 1, 5, 669200, 34854.2, '2022-01-27 17:04:34', 'Print', 'FTDKS-10'),
(11, 1, 5, 669200, 34854.2, '2022-01-27 17:05:56', 'Print', 'FTDKS-11'),
(12, 1, 5, 669200, 34854.2, '2022-01-27 17:07:35', 'Print', 'FTDKS-12'),
(13, 1, 5, 57600, 3000, '2022-01-27 17:08:28', 'Print', 'FTDKS-13'),
(14, 1, 5, 669200, 34854.2, '2022-01-27 17:13:34', 'Print', 'FTDKS-14'),
(15, 1, 3, 19200, 1000, '2022-01-27 17:20:57', 'Print', 'FTDKS-15'),
(16, 1, 3, 19200, 1000, '2022-01-27 17:26:14', 'Print', 'FTDKS-16'),
(17, 1, 3, 19200, 1000, '2022-01-27 17:26:55', 'Print', 'FTDKS2022013018'),
(18, 1, 1, 19200, 1000, '2022-01-30 08:48:05', 'Print', 'FTDKS2022013018'),
(19, 1, 2, 19200, 1000, '2022-01-30 08:49:58', 'Print', 'FTDKS2022013018'),
(20, 1, 1, 19200, 1000, '2022-01-30 10:21:13', 'Print', 'FTDKS2022013020'),
(21, 1, 2, 19200, 1000, '2022-01-30 10:21:19', 'Print', 'FTDKS2022013020');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_affectermontantenespece`
--
ALTER TABLE `t_affectermontantenespece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_daterecharge`
--
ALTER TABLE `t_daterecharge`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_decodeur`
--
ALTER TABLE `t_decodeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_detailprixproduit`
--
ALTER TABLE `t_detailprixproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_dette`
--
ALTER TABLE `t_dette`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_historiqueapprove_banking`
--
ALTER TABLE `t_historiqueapprove_banking`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_historiquechange`
--
ALTER TABLE `t_historiquechange`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_historiquee_banking`
--
ALTER TABLE `t_historiquee_banking`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_lignerecharge`
--
ALTER TABLE `t_lignerecharge`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_motantespece`
--
ALTER TABLE `t_motantespece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_operation`
--
ALTER TABLE `t_operation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_organisation`
--
ALTER TABLE `t_organisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_prixproduit`
--
ALTER TABLE `t_prixproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_produit`
--
ALTER TABLE `t_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_reabonner`
--
ALTER TABLE `t_reabonner`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_taux`
--
ALTER TABLE `t_taux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_telephone`
--
ALTER TABLE `t_telephone`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_venteunite`
--
ALTER TABLE `t_venteunite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_affectermontantenespece`
--
ALTER TABLE `t_affectermontantenespece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_daterecharge`
--
ALTER TABLE `t_daterecharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_decodeur`
--
ALTER TABLE `t_decodeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_detailprixproduit`
--
ALTER TABLE `t_detailprixproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_dette`
--
ALTER TABLE `t_dette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_historiqueapprove_banking`
--
ALTER TABLE `t_historiqueapprove_banking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_historiquechange`
--
ALTER TABLE `t_historiquechange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_historiquee_banking`
--
ALTER TABLE `t_historiquee_banking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_lignerecharge`
--
ALTER TABLE `t_lignerecharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `t_motantespece`
--
ALTER TABLE `t_motantespece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `t_operation`
--
ALTER TABLE `t_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_organisation`
--
ALTER TABLE `t_organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_prixproduit`
--
ALTER TABLE `t_prixproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_produit`
--
ALTER TABLE `t_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_reabonner`
--
ALTER TABLE `t_reabonner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `t_taux`
--
ALTER TABLE `t_taux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_telephone`
--
ALTER TABLE `t_telephone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `t_venteunite`
--
ALTER TABLE `t_venteunite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
