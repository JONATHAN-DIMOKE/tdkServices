<?php

/**
 * Created by PhpStorm.
 * User: ISRA NDAYA
 * Date: 13/01/2022
 * Time: 18:09
 */
class LigneRecharge
{
    private $id;
    private $idProduit;
    private $idDateRecharge;
    private $montantInitialEspeceE;
    private $stockInitialUsdE;
    private $stockInitialCdfE;
    private $approvCdfE;
    private $approvUsdE;
    private $newStockUsdE;
    private $newStockCdfE;
    private $montantClotureUsdE;
    private $montantClotureCdfE;
    private $entreeCdfE;
    private $entreeUsdE;
    private $sortieUsdE;
    private $sortieCdfE;
    private $denominationR;
    private $ballanceR;
    private $approvR;
    private $newBallanceR;
    private $soldeR;
    private $restantR;
    private $denominationK;
    private $stockInitialK;
    private $approvK;
    private $newStockK;
    private $venteK;
    private $puK;
    private $soldeK;
    private $stockRestantK;
    private $reseauU;
    private $ballanceU;
    private $approvU;
    private $newBallanceU;
    private $venteU;
    private $puU;
    private $soldeU;
    private $restantU;
    private $capitalC;
    private $changeC;
    private $tauxC;
    private $resteC;
    private $reseauCOM;
    private $commissionInitialeCDF;
    private $commissionInitialeUSD;
    private $commissionFinaleCDF;
    private $commissionFinaleUSD;
    private $beneficeCDF;
    private $beneficeUSD;

    /**
     * LigneRecharge constructor.
     * @param $id
     * @param $idProduit
     * @param $idDateRecharge
     * @param $montantInitialEspeceE
     * @param $stockInitialUsdE
     * @param $stockInitialCdfE
     * @param $approvCdfE
     * @param $approvUsdE
     * @param $newStockUsdE
     * @param $newStockCdfE
     * @param $montantClotureUsdE
     * @param $montantClotureCdfE
     * @param $entreeCdfE
     * @param $entreeUsdE
     * @param $sortieUsdE
     * @param $sortieCdfE
     * @param $denominationR
     * @param $ballanceR
     * @param $approvR
     * @param $newBallanceR
     * @param $soldeR
     * @param $restantR
     * @param $denominationK
     * @param $stockInitialK
     * @param $approvK
     * @param $newStockK
     * @param $venteK
     * @param $puK
     * @param $soldeK
     * @param $stockRestantK
     * @param $reseauU
     * @param $ballanceU
     * @param $approvU
     * @param $newBallanceU
     * @param $venteU
     * @param $puU
     * @param $soldeU
     * @param $restantU
     * @param $capitalC
     * @param $changeC
     * @param $tauxC
     * @param $resteC
     * @param $reseauCOM
     * @param $commissionInitialeCDF
     * @param $commissionInitialeUSD
     * @param $commissionFinaleCDF
     * @param $commissionFinaleUSD
     * @param $beneficeCDF
     * @param $beneficeUSD
     */
    public function __construct($id, $idProduit, $idDateRecharge, $montantInitialEspeceE, $stockInitialUsdE, $stockInitialCdfE, $approvCdfE, $approvUsdE, $newStockUsdE, $newStockCdfE, $montantClotureUsdE, $montantClotureCdfE, $entreeCdfE, $entreeUsdE, $sortieUsdE, $sortieCdfE, $denominationR, $ballanceR, $approvR, $newBallanceR, $soldeR, $restantR, $denominationK, $stockInitialK, $approvK, $newStockK, $venteK, $puK, $soldeK, $stockRestantK, $reseauU, $ballanceU, $approvU, $newBallanceU, $venteU, $puU, $soldeU, $restantU, $capitalC, $changeC, $tauxC, $resteC, $reseauCOM, $commissionInitialeCDF, $commissionInitialeUSD, $commissionFinaleCDF, $commissionFinaleUSD, $beneficeCDF, $beneficeUSD)
    {
        $this->id = $id;
        $this->idProduit = $idProduit;
        $this->idDateRecharge = $idDateRecharge;
        $this->montantInitialEspeceE = $montantInitialEspeceE;
        $this->stockInitialUsdE = $stockInitialUsdE;
        $this->stockInitialCdfE = $stockInitialCdfE;
        $this->approvCdfE = $approvCdfE;
        $this->approvUsdE = $approvUsdE;
        $this->newStockUsdE = $newStockUsdE;
        $this->newStockCdfE = $newStockCdfE;
        $this->montantClotureUsdE = $montantClotureUsdE;
        $this->montantClotureCdfE = $montantClotureCdfE;
        $this->entreeCdfE = $entreeCdfE;
        $this->entreeUsdE = $entreeUsdE;
        $this->sortieUsdE = $sortieUsdE;
        $this->sortieCdfE = $sortieCdfE;
        $this->denominationR = $denominationR;
        $this->ballanceR = $ballanceR;
        $this->approvR = $approvR;
        $this->newBallanceR = $newBallanceR;
        $this->soldeR = $soldeR;
        $this->restantR = $restantR;
        $this->denominationK = $denominationK;
        $this->stockInitialK = $stockInitialK;
        $this->approvK = $approvK;
        $this->newStockK = $newStockK;
        $this->venteK = $venteK;
        $this->puK = $puK;
        $this->soldeK = $soldeK;
        $this->stockRestantK = $stockRestantK;
        $this->reseauU = $reseauU;
        $this->ballanceU = $ballanceU;
        $this->approvU = $approvU;
        $this->newBallanceU = $newBallanceU;
        $this->venteU = $venteU;
        $this->puU = $puU;
        $this->soldeU = $soldeU;
        $this->restantU = $restantU;
        $this->capitalC = $capitalC;
        $this->changeC = $changeC;
        $this->tauxC = $tauxC;
        $this->resteC = $resteC;
        $this->reseauCOM = $reseauCOM;
        $this->commissionInitialeCDF = $commissionInitialeCDF;
        $this->commissionInitialeUSD = $commissionInitialeUSD;
        $this->commissionFinaleCDF = $commissionFinaleCDF;
        $this->commissionFinaleUSD = $commissionFinaleUSD;
        $this->beneficeCDF = $beneficeCDF;
        $this->beneficeUSD = $beneficeUSD;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param mixed $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return mixed
     */
    public function getIdDateRecharge()
    {
        return $this->idDateRecharge;
    }

    /**
     * @param mixed $idDateRecharge
     */
    public function setIdDateRecharge($idDateRecharge)
    {
        $this->idDateRecharge = $idDateRecharge;
    }

    /**
     * @return mixed
     */
    public function getMontantInitialEspeceE()
    {
        return $this->montantInitialEspeceE;
    }

    /**
     * @param mixed $montantInitialEspeceE
     */
    public function setMontantInitialEspeceE($montantInitialEspeceE)
    {
        $this->montantInitialEspeceE = $montantInitialEspeceE;
    }

    /**
     * @return mixed
     */
    public function getStockInitialUsdE()
    {
        return $this->stockInitialUsdE;
    }

    /**
     * @param mixed $stockInitialUsdE
     */
    public function setStockInitialUsdE($stockInitialUsdE)
    {
        $this->stockInitialUsdE = $stockInitialUsdE;
    }

    /**
     * @return mixed
     */
    public function getStockInitialCdfE()
    {
        return $this->stockInitialCdfE;
    }

    /**
     * @param mixed $stockInitialCdfE
     */
    public function setStockInitialCdfE($stockInitialCdfE)
    {
        $this->stockInitialCdfE = $stockInitialCdfE;
    }

    /**
     * @return mixed
     */
    public function getApprovCdfE()
    {
        return $this->approvCdfE;
    }

    /**
     * @param mixed $approvCdfE
     */
    public function setApprovCdfE($approvCdfE)
    {
        $this->approvCdfE = $approvCdfE;
    }

    /**
     * @return mixed
     */
    public function getApprovUsdE()
    {
        return $this->approvUsdE;
    }

    /**
     * @param mixed $approvUsdE
     */
    public function setApprovUsdE($approvUsdE)
    {
        $this->approvUsdE = $approvUsdE;
    }

    /**
     * @return mixed
     */
    public function getNewStockUsdE()
    {
        return $this->newStockUsdE;
    }

    /**
     * @param mixed $newStockUsdE
     */
    public function setNewStockUsdE($newStockUsdE)
    {
        $this->newStockUsdE = $newStockUsdE;
    }

    /**
     * @return mixed
     */
    public function getNewStockCdfE()
    {
        return $this->newStockCdfE;
    }

    /**
     * @param mixed $newStockCdfE
     */
    public function setNewStockCdfE($newStockCdfE)
    {
        $this->newStockCdfE = $newStockCdfE;
    }

    /**
     * @return mixed
     */
    public function getMontantClotureUsdE()
    {
        return $this->montantClotureUsdE;
    }

    /**
     * @param mixed $montantClotureUsdE
     */
    public function setMontantClotureUsdE($montantClotureUsdE)
    {
        $this->montantClotureUsdE = $montantClotureUsdE;
    }

    /**
     * @return mixed
     */
    public function getMontantClotureCdfE()
    {
        return $this->montantClotureCdfE;
    }

    /**
     * @param mixed $montantClotureCdfE
     */
    public function setMontantClotureCdfE($montantClotureCdfE)
    {
        $this->montantClotureCdfE = $montantClotureCdfE;
    }

    /**
     * @return mixed
     */
    public function getEntreeCdfE()
    {
        return $this->entreeCdfE;
    }

    /**
     * @param mixed $entreeCdfE
     */
    public function setEntreeCdfE($entreeCdfE)
    {
        $this->entreeCdfE = $entreeCdfE;
    }

    /**
     * @return mixed
     */
    public function getEntreeUsdE()
    {
        return $this->entreeUsdE;
    }

    /**
     * @param mixed $entreeUsdE
     */
    public function setEntreeUsdE($entreeUsdE)
    {
        $this->entreeUsdE = $entreeUsdE;
    }

    /**
     * @return mixed
     */
    public function getSortieUsdE()
    {
        return $this->sortieUsdE;
    }

    /**
     * @param mixed $sortieUsdE
     */
    public function setSortieUsdE($sortieUsdE)
    {
        $this->sortieUsdE = $sortieUsdE;
    }

    /**
     * @return mixed
     */
    public function getSortieCdfE()
    {
        return $this->sortieCdfE;
    }

    /**
     * @param mixed $sortieCdfE
     */
    public function setSortieCdfE($sortieCdfE)
    {
        $this->sortieCdfE = $sortieCdfE;
    }

    /**
     * @return mixed
     */
    public function getDenominationR()
    {
        return $this->denominationR;
    }

    /**
     * @param mixed $denominationR
     */
    public function setDenominationR($denominationR)
    {
        $this->denominationR = $denominationR;
    }

    /**
     * @return mixed
     */
    public function getBallanceR()
    {
        return $this->ballanceR;
    }

    /**
     * @param mixed $ballanceR
     */
    public function setBallanceR($ballanceR)
    {
        $this->ballanceR = $ballanceR;
    }

    /**
     * @return mixed
     */
    public function getApprovR()
    {
        return $this->approvR;
    }

    /**
     * @param mixed $approvR
     */
    public function setApprovR($approvR)
    {
        $this->approvR = $approvR;
    }

    /**
     * @return mixed
     */
    public function getNewBallanceR()
    {
        return $this->newBallanceR;
    }

    /**
     * @param mixed $newBallanceR
     */
    public function setNewBallanceR($newBallanceR)
    {
        $this->newBallanceR = $newBallanceR;
    }

    /**
     * @return mixed
     */
    public function getSoldeR()
    {
        return $this->soldeR;
    }

    /**
     * @param mixed $soldeR
     */
    public function setSoldeR($soldeR)
    {
        $this->soldeR = $soldeR;
    }

    /**
     * @return mixed
     */
    public function getRestantR()
    {
        return $this->restantR;
    }

    /**
     * @param mixed $restantR
     */
    public function setRestantR($restantR)
    {
        $this->restantR = $restantR;
    }

    /**
     * @return mixed
     */
    public function getDenominationK()
    {
        return $this->denominationK;
    }

    /**
     * @param mixed $denominationK
     */
    public function setDenominationK($denominationK)
    {
        $this->denominationK = $denominationK;
    }

    /**
     * @return mixed
     */
    public function getStockInitialK()
    {
        return $this->stockInitialK;
    }

    /**
     * @param mixed $stockInitialK
     */
    public function setStockInitialK($stockInitialK)
    {
        $this->stockInitialK = $stockInitialK;
    }

    /**
     * @return mixed
     */
    public function getApprovK()
    {
        return $this->approvK;
    }

    /**
     * @param mixed $approvK
     */
    public function setApprovK($approvK)
    {
        $this->approvK = $approvK;
    }

    /**
     * @return mixed
     */
    public function getNewStockK()
    {
        return $this->newStockK;
    }

    /**
     * @param mixed $newStockK
     */
    public function setNewStockK($newStockK)
    {
        $this->newStockK = $newStockK;
    }

    /**
     * @return mixed
     */
    public function getVenteK()
    {
        return $this->venteK;
    }

    /**
     * @param mixed $venteK
     */
    public function setVenteK($venteK)
    {
        $this->venteK = $venteK;
    }

    /**
     * @return mixed
     */
    public function getPuK()
    {
        return $this->puK;
    }

    /**
     * @param mixed $puK
     */
    public function setPuK($puK)
    {
        $this->puK = $puK;
    }

    /**
     * @return mixed
     */
    public function getSoldeK()
    {
        return $this->soldeK;
    }

    /**
     * @param mixed $soldeK
     */
    public function setSoldeK($soldeK)
    {
        $this->soldeK = $soldeK;
    }

    /**
     * @return mixed
     */
    public function getStockRestantK()
    {
        return $this->stockRestantK;
    }

    /**
     * @param mixed $stockRestantK
     */
    public function setStockRestantK($stockRestantK)
    {
        $this->stockRestantK = $stockRestantK;
    }

    /**
     * @return mixed
     */
    public function getReseauU()
    {
        return $this->reseauU;
    }

    /**
     * @param mixed $reseauU
     */
    public function setReseauU($reseauU)
    {
        $this->reseauU = $reseauU;
    }

    /**
     * @return mixed
     */
    public function getBallanceU()
    {
        return $this->ballanceU;
    }

    /**
     * @param mixed $ballanceU
     */
    public function setBallanceU($ballanceU)
    {
        $this->ballanceU = $ballanceU;
    }

    /**
     * @return mixed
     */
    public function getApprovU()
    {
        return $this->approvU;
    }

    /**
     * @param mixed $approvU
     */
    public function setApprovU($approvU)
    {
        $this->approvU = $approvU;
    }

    /**
     * @return mixed
     */
    public function getNewBallanceU()
    {
        return $this->newBallanceU;
    }

    /**
     * @param mixed $newBallanceU
     */
    public function setNewBallanceU($newBallanceU)
    {
        $this->newBallanceU = $newBallanceU;
    }

    /**
     * @return mixed
     */
    public function getVenteU()
    {
        return $this->venteU;
    }

    /**
     * @param mixed $venteU
     */
    public function setVenteU($venteU)
    {
        $this->venteU = $venteU;
    }

    /**
     * @return mixed
     */
    public function getPuU()
    {
        return $this->puU;
    }

    /**
     * @param mixed $puU
     */
    public function setPuU($puU)
    {
        $this->puU = $puU;
    }

    /**
     * @return mixed
     */
    public function getSoldeU()
    {
        return $this->soldeU;
    }

    /**
     * @param mixed $soldeU
     */
    public function setSoldeU($soldeU)
    {
        $this->soldeU = $soldeU;
    }

    /**
     * @return mixed
     */
    public function getRestantU()
    {
        return $this->restantU;
    }

    /**
     * @param mixed $restantU
     */
    public function setRestantU($restantU)
    {
        $this->restantU = $restantU;
    }

    /**
     * @return mixed
     */
    public function getCapitalC()
    {
        return $this->capitalC;
    }

    /**
     * @param mixed $capitalC
     */
    public function setCapitalC($capitalC)
    {
        $this->capitalC = $capitalC;
    }

    /**
     * @return mixed
     */
    public function getChangeC()
    {
        return $this->changeC;
    }

    /**
     * @param mixed $changeC
     */
    public function setChangeC($changeC)
    {
        $this->changeC = $changeC;
    }

    /**
     * @return mixed
     */
    public function getTauxC()
    {
        return $this->tauxC;
    }

    /**
     * @param mixed $tauxC
     */
    public function setTauxC($tauxC)
    {
        $this->tauxC = $tauxC;
    }

    /**
     * @return mixed
     */
    public function getResteC()
    {
        return $this->resteC;
    }

    /**
     * @param mixed $resteC
     */
    public function setResteC($resteC)
    {
        $this->resteC = $resteC;
    }

    /**
     * @return mixed
     */
    public function getReseauCOM()
    {
        return $this->reseauCOM;
    }

    /**
     * @param mixed $reseauCOM
     */
    public function setReseauCOM($reseauCOM)
    {
        $this->reseauCOM = $reseauCOM;
    }

    /**
     * @return mixed
     */
    public function getCommissionInitialeCDF()
    {
        return $this->commissionInitialeCDF;
    }

    /**
     * @param mixed $commissionInitialeCDF
     */
    public function setCommissionInitialeCDF($commissionInitialeCDF)
    {
        $this->commissionInitialeCDF = $commissionInitialeCDF;
    }

    /**
     * @return mixed
     */
    public function getCommissionInitialeUSD()
    {
        return $this->commissionInitialeUSD;
    }

    /**
     * @param mixed $commissionInitialeUSD
     */
    public function setCommissionInitialeUSD($commissionInitialeUSD)
    {
        $this->commissionInitialeUSD = $commissionInitialeUSD;
    }

    /**
     * @return mixed
     */
    public function getCommissionFinaleCDF()
    {
        return $this->commissionFinaleCDF;
    }

    /**
     * @param mixed $commissionFinaleCDF
     */
    public function setCommissionFinaleCDF($commissionFinaleCDF)
    {
        $this->commissionFinaleCDF = $commissionFinaleCDF;
    }

    /**
     * @return mixed
     */
    public function getCommissionFinaleUSD()
    {
        return $this->commissionFinaleUSD;
    }

    /**
     * @param mixed $commissionFinaleUSD
     */
    public function setCommissionFinaleUSD($commissionFinaleUSD)
    {
        $this->commissionFinaleUSD = $commissionFinaleUSD;
    }

    /**
     * @return mixed
     */
    public function getBeneficeCDF()
    {
        return $this->beneficeCDF;
    }

    /**
     * @param mixed $beneficeCDF
     */
    public function setBeneficeCDF($beneficeCDF)
    {
        $this->beneficeCDF = $beneficeCDF;
    }

    /**
     * @return mixed
     */
    public function getBeneficeUSD()
    {
        return $this->beneficeUSD;
    }

    /**
     * @param mixed $beneficeUSD
     */
    public function setBeneficeUSD($beneficeUSD)
    {
        $this->beneficeUSD = $beneficeUSD;
    }


}