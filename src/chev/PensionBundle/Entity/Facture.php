<?php

namespace chev\PensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chev\PensionBundle\Entity\Facture
 */
class Facture
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $libelle
     */
    private $libelle;

    /**
     * @var \DateTime $dureeSejour
     */
    private $dureeSejour;

    /**
     * @var \DateTime $datePaiement
     */
    private $datePaiement;

    /**
     * @var float $montant
     */
    private $montant;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Facture
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dureeSejour
     *
     * @param \DateTime $dureeSejour
     * @return Facture
     */
    public function setDureeSejour($dureeSejour)
    {
        $this->dureeSejour = $dureeSejour;
    
        return $this;
    }

    /**
     * Get dureeSejour
     *
     * @return \DateTime 
     */
    public function getDureeSejour()
    {
        return $this->dureeSejour;
    }

    /**
     * Set datePaiement
     *
     * @param \DateTime $datePaiement
     * @return Facture
     */
    public function setDatePaiement($datePaiement)
    {
        $this->datePaiement = $datePaiement;
    
        return $this;
    }

    /**
     * Get datePaiement
     *
     * @return \DateTime 
     */
    public function getDatePaiement()
    {
        return $this->datePaiement;
    }

    /**
     * Set montant
     *
     * @param float $montant
     * @return Facture
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    
        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }
}
