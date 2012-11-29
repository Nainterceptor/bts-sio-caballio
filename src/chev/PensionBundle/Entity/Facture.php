<?php

namespace chev\PensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chev\PensionBundle\Entity\Facture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\PensionBundle\Entity\FactureRepository")
 */
class Facture
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $datePaiement
     *
     * @ORM\Column(name="datePaiement", type="datetime")
     */
    private $datePaiement;

    /**
     * @var integer $pension
     *
     * @ORM\Column(name="pension", type="integer")
     */
    private $pension;

    /**
     * @var float $montant
     *
     * @ORM\Column(name="montant", type="float")
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
     * Set pension
     *
     * @param integer $pension
     * @return Facture
     */
    public function setPension($pension)
    {
        $this->pension = $pension;
    
        return $this;
    }

    /**
     * Get pension
     *
     * @return integer 
     */
    public function getPension()
    {
        return $this->pension;
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
