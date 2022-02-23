-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 15 jan. 2022 à 17:04
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_affectPhone` (IN `p_idClient` INT, IN `p_idUtulisateur` INT, IN `p_tel` VARCHAR(14), IN `p_reseau` VARCHAR(50))  BEGIN
	INSERT t_telephone(id, idClient, idRespCUR, tel, reseau) VALUES(0, p_idClient, p_idUtulisateur, p_tel, p_reseau);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_connectUser` (IN `p_codeAgent` VARCHAR(10), IN `p_pwd` VARCHAR(255))  BEGIN
	SELECT * FROM t_utilisateur WHERE codeAgent = p_codeAgent AND pwd = p_pwd AND statut = "Actif";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllClient` ()  BEGIN
	SELECT * FROM t_utilisateur WHERE typeUser = 'Client';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllReseaux` (IN `p_idClient` INT)  BEGIN
	SELECT * FROM t_telephone WHERE id IN (SELECT id FROM t_telephone WHERE idClient = p_idClient);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getDetteForClient` (IN `p_id` INT)  NO SQL
BEGIN
select t_utilisateur.nom, t_produit.designation,  t_dette.id, t_dette.dateDette, t_dette.montant, t_dette.note, t_dette.idUtilisateur, t_dette.etatDette, t_dette.reseau, t_dette.idClient 
from t_dette inner join t_utilisateur on t_dette.idClient = t_Utilisateur.id inner join t_produit on t_produit.id = t_dette.idProduit inner join t_lignerecharge on t_dette.reseau IN (SELECT reseauU FROM t_lignerecharge) where t_utilisateur.typeUser = 'Client' and t_utilisateur.id=t_dette.idClient and t_utilisateur.id = p_id GROUP BY t_dette.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getPayeDette` ()  NO SQL
BEGIN
select t_utilisateur.nom, t_produit.designation,  t_dette.id, t_dette.dateDette, t_dette.montant, t_dette.note, t_dette.idUtilisateur, t_dette.etatDette, t_dette.reseau, t_dette.idClient
from t_dette inner join t_utilisateur on t_dette.idClient = t_Utilisateur.id inner join t_produit on t_produit.id = t_dette.idProduit inner join t_lignerecharge on t_dette.reseau IN (SELECT reseauU FROM t_lignerecharge)
where t_utilisateur.typeUser = 'Client' and (t_dette.etatDette = 'Non paye' or t_dette.etatDette = 'En cours')  GROUP BY t_dette.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_saveClient` (IN `p_nom` VARCHAR(255), IN `p_tel` VARCHAR(14), IN `p_genre` VARCHAR(1), IN `p_categorie` VARCHAR(255), IN `p_adresse` VARCHAR(255))  BEGIN INSERT t_utilisateur(id, codeAgent, nom, tel, genre, etatCivil, typeUser, categorie, statut, etatConnection, pwd, adresse) VALUES(0, '', p_nom, p_tel, p_genre, '', 'Client',p_categorie, '', '', '', p_adresse); END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_saveSaleToDette` (IN `p_idClient` INT, IN `p_montant` FLOAT, IN `p_idUtilisateur` INT, IN `p_reseau` INT)  BEGIN
	DECLARE v_idProduit INT;
    DECLARE v_idDetteAncien INT;
    DECLARE v_countTableContent INT;
    
    SELECT COUNT(*) INTO v_countTableContent FROM t_dette;
    SELECT id INTO v_idProduit FROM t_produit WHERE t_produit.designation = 'Unite';
    IF v_countTableContent <> 0 THEN
    	SELECT id INTO v_idDetteAncien FROM t_dette ORDER BY id DESC;
    END IF;
    
	INSERT t_dette(id, idProduit, idClient, montant, dateDette, etatDette, idUtilisateur, note, reseau, refDette) VALUES(0, v_idProduit, p_idClient, p_montant, NOW(), 'Non paye', p_idUtilisateur, "Suite a manque, le client a pris une dette chez TDK Services", CONCAT('Ref/dette/','-',v_idDetteAncien + 1));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_updatePwd` (IN `p_pwd` VARCHAR(255), IN `p_codeAgent` VARCHAR(10))  BEGIN UPDATE t_utilisateur SET pwd = p_pwd WHERE codeAgent = p_codeAgent; END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_affectermontantenespece`
--

CREATE TABLE `t_affectermontantenespece` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idMontant` int(11) NOT NULL,
  `dateAffectation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_daterecharge`
--

CREATE TABLE `t_daterecharge` (
  `id` int(11) NOT NULL,
  `jour` int(11) NOT NULL,
  `mois` enum('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre','') NOT NULL,
  `annee` int(11) NOT NULL,
  `heure` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_daterecharge`
--

INSERT INTO `t_daterecharge` (`id`, `jour`, `mois`, `annee`, `heure`) VALUES
(1, 12, 'Juin', 2020, '12h30'),
(2, 23, 'Avril', 2021, '13h28');

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
(1, 1, 2, 250000, '14/01/2022', 'Non paye', 1, 'Cette dette a ete accordee pour une duree de deux semaines', 'Airtel', ''),
(2, 1, 2, 350000, '10/01/2022', 'En cours', 1, 'cette dette a ete accordee pour une duree de trois semaines maximum', 'Orange', '');

-- --------------------------------------------------------

--
-- Structure de la table `t_lignerecharge`
--

CREATE TABLE `t_lignerecharge` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `idDateRecharge` int(11) NOT NULL,
  `idTel` int(11) NOT NULL,
  `montantInitialEspeceE` float NOT NULL,
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
  `denominationR` enum('','Orange money','M-Pesa','Pepele mobile','Airtel money') NOT NULL,
  `ballanceR` float NOT NULL,
  `approvR` float NOT NULL,
  `newBallanceR` float NOT NULL,
  `soldeR` float NOT NULL,
  `restantR` float NOT NULL,
  `denominationK` enum('','EasyTv','Canal+','StarTimess') NOT NULL,
  `stockinitialK` float NOT NULL,
  `approvK` float NOT NULL,
  `newStockK` float NOT NULL,
  `venteK` float NOT NULL,
  `puK` float NOT NULL,
  `soldeK` float NOT NULL,
  `stockRestantK` float NOT NULL,
  `reseauU` enum('Airtel','Orange','VodaCom','Africell','') NOT NULL,
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
  `reseauCOM` enum('','M-Pesa','Orange money','Pepele mobil','Airtel money') NOT NULL,
  `commissionInitialeCDF` float NOT NULL,
  `commissionInitialeUSD` float NOT NULL,
  `commissionFinaleCDF` float NOT NULL,
  `commissionFinaleUSD` float NOT NULL,
  `beneficeCDF` float NOT NULL,
  `beneficeUSD` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_lignerecharge`
--

INSERT INTO `t_lignerecharge` (`id`, `idProduit`, `idDateRecharge`, `idTel`, `montantInitialEspeceE`, `stockinitialusdE`, `stockinitialcdfE`, `approvcdfE`, `approvusdE`, `newStockcdfE`, `newStockusdE`, `montantCloturecdfE`, `montantClotureusdE`, `entreecdfE`, `entreeusdE`, `sortiecdfE`, `sortieusdE`, `denominationR`, `ballanceR`, `approvR`, `newBallanceR`, `soldeR`, `restantR`, `denominationK`, `stockinitialK`, `approvK`, `newStockK`, `venteK`, `puK`, `soldeK`, `stockRestantK`, `reseauU`, `ballanceU`, `approvU`, `newBallanceU`, `venteU`, `puU`, `soldeU`, `restantU`, `capitalC`, `changeC`, `tauxC`, `resteC`, `reseauCOM`, `commissionInitialeCDF`, `commissionInitialeUSD`, `commissionFinaleCDF`, `commissionFinaleUSD`, `beneficeCDF`, `beneficeUSD`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, '', 57106, 0, 57106, 0, 192, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(2, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 2000, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(3, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 2000, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(4, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(5, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(6, 1, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(7, 1, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(8, 1, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(9, 1, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 57106, 0, 0, 8, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(10, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 57106, 0, 0, 500, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(11, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 'StarTimess', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 57106, 0, 57106, 500, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(12, 1, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 57106, 0, 56606, 500, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(13, 1, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 56606, 0, 56606, 500, 0, 0, 0, 0, 0, 0, 0, 'Airtel money', 0, 0, 0, 0, 0, 0),
(14, 1, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 56386, 0, 56386, 220, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(15, 1, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 56166, 0, 56166, 220, 192, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(16, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 56162, 0, 56162, 4, 192, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(17, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 56162, 0, 56162, 5, 192, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(18, 1, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', 55962, 0, 55962, 200, 192, 38400, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(19, 1, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', -18648, 0, -18648, 74610, 192, 14325100, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(20, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', -93258, 0, -93258, 74610, 19.2, 14325100, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(21, 1, 2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'VodaCom', -99458, 0, -99458, 6200, 19.2, 119040, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(22, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Airtel', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(23, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'Orange', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0);

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

-- --------------------------------------------------------

--
-- Structure de la table `t_operation`
--

CREATE TABLE `t_operation` (
  `id` int(11) NOT NULL,
  `typeOperation` enum('Retrait achat','Retrait depense','Retrait Taxes et Import') NOT NULL,
  `raison` text NOT NULL,
  `dateOperation` varchar(15) NOT NULL,
  `idDemandeur` int(11) NOT NULL,
  `idGerant` int(11) NOT NULL
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

-- --------------------------------------------------------

--
-- Structure de la table `t_produit`
--

CREATE TABLE `t_produit` (
  `id` int(11) NOT NULL,
  `designation` enum('Kit','Argent','Unite','Reabonnement') NOT NULL,
  `typeProduit` enum('Produit virtuel','Produit materiel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_produit`
--

INSERT INTO `t_produit` (`id`, `designation`, `typeProduit`) VALUES
(1, 'Unite', 'Produit virtuel');

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
(1, 2, 1, '+243 972580358', 'Airtel'),
(2, 3, 2, '+243 81087637', 'VodaCom'),
(3, 3, 2, '+243 81087637', 'VodaCom'),
(4, 2, 1, '+24382098473', 'VodaCom'),
(5, 2, 1, '+243 972876453', 'Airtel');

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
  `categorie` enum('Agent','Telecom','Cambiste') NOT NULL,
  `statut` enum('Actif','Bloque','') NOT NULL,
  `etatConnection` enum('Connected','Disconnected','') NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`id`, `codeAgent`, `nom`, `tel`, `genre`, `etatCivil`, `typeUser`, `categorie`, `statut`, `etatConnection`, `pwd`, `adresse`) VALUES
(1, 'TDK001', 'Jonathan DIMOKE', '', 'M', 'Celibataire', 'Responsable CUR', 'Agent', 'Actif', 'Disconnected', '123456', ''),
(2, '', 'Simplice MWEMBO', '+243 9087637', 'M', '', 'Client', 'Cambiste', '', '', '', 'kasai'),
(3, '', 'Ousmane ILUNGA', '+243 8987637', 'M', '', 'Client', 'Cambiste', '', '', '', 'kasai'),
(4, '', 'Simplice MWEMBO', '+243 9087637', 'M', '', 'Client', 'Cambiste', '', '', '', 'kasai'),
(5, '', 'Simplice MWEMBO', '+243 9087637', 'M', '', 'Client', 'Cambiste', '', '', '', 'kasai');

-- --------------------------------------------------------

--
-- Structure de la table `t_venteunite`
--

CREATE TABLE `t_venteunite` (
  `id` int(11) NOT NULL,
  `idRespCUR` int(11) NOT NULL,
  `idTel` int(11) NOT NULL,
  `montant` float NOT NULL,
  `dateVente` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_venteunite`
--

INSERT INTO `t_venteunite` (`id`, `idRespCUR`, `idTel`, `montant`, `dateVente`) VALUES
(1, 1, 1, 2000, '2022-01-15 11:34:01'),
(2, 1, 1, 2000, '2022-01-15 11:34:02'),
(3, 1, 1, 300, '2022-01-15 11:36:25'),
(4, 1, 1, 300, '2022-01-15 11:36:26'),
(5, 1, 4, 7, '2022-01-15 11:37:27'),
(6, 1, 4, 7, '2022-01-15 11:37:27'),
(7, 1, 5, 8, '2022-01-15 11:37:32'),
(8, 1, 5, 8, '2022-01-15 11:37:33'),
(9, 1, 1, 500, '2022-01-15 12:01:39'),
(10, 1, 1, 500, '2022-01-15 12:01:39'),
(11, 1, 4, 500, '2022-01-15 12:07:36'),
(12, 1, 4, 500, '2022-01-15 12:07:37'),
(13, 1, 2, 220, '2022-01-15 12:48:12'),
(14, 1, 2, 220, '2022-01-15 12:48:13'),
(15, 1, 1, 4, '2022-01-15 14:34:22'),
(16, 1, 1, 0, '2022-01-15 14:48:09'),
(17, 1, 4, 200, '2022-01-15 14:54:52'),
(18, 1, 5, 74610, '2022-01-15 14:58:06'),
(19, 1, 1, 74610, '2022-01-15 15:01:41'),
(20, 1, 4, 6200, '2022-01-15 15:07:23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_daterecharge`
--
ALTER TABLE `t_daterecharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_detailprixproduit`
--
ALTER TABLE `t_detailprixproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_dette`
--
ALTER TABLE `t_dette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_lignerecharge`
--
ALTER TABLE `t_lignerecharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `t_motantespece`
--
ALTER TABLE `t_motantespece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_operation`
--
ALTER TABLE `t_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_prixproduit`
--
ALTER TABLE `t_prixproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_produit`
--
ALTER TABLE `t_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_taux`
--
ALTER TABLE `t_taux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_telephone`
--
ALTER TABLE `t_telephone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_venteunite`
--
ALTER TABLE `t_venteunite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
