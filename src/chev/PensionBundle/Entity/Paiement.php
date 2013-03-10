<?php

namespace chev\PensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\PensionBundle\Entity\Paiement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\PensionBundle\Entity\PaiementRepository")
 */
class Paiement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var integer
     * 
     * @ORM\ManyToOne(targetEntity="chev\PensionBundle\Entity\Facture")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $facture;

    /**
     *
     * @ORM\ManyToOne(targetEntity="chev\PensionBundle\Entity\TypePaiement")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $typePaiement;

    /**
     * @var \DateTime $datePaiement
     *
     * @ORM\Column(name="datePaiement", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $datePaiement;

    /**
     * @var \DateTime $dateEncaissement
     *
     * @ORM\Column(name="dateEncaissement", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $dateEncaissement;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     * @Assert\NotBlank()
     * @Assert\Type(type="float", message="Ce montant : {{ value }} ,n'est pas un {{ type }}.")
     */
    private $montant;
    
    public function __construct() {
        $this->datePaiement = new \DateTime();
        $this->dateEncaissement = new \DateTime();
    }

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
     * @return Paiement
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
     * Set dateEncaissement
     *
     * @param \DateTime $dateEncaissement
     * @return Paiement
     */
    public function setDateEncaissement($dateEncaissement)
    {
        $this->dateEncaissement = $dateEncaissement;
    
        return $this;
    }

    /**
     * Get dateEncaissement
     *
     * @return \DateTime 
     */
    public function getDateEncaissement()
    {
        return $this->dateEncaissement;
    }

    /**
     * Set montant
     *
     * @param float $montant
     * @return Paiement
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

    /**
     * Set facture
     *
     * @param \chev\PensionBundle\Entity\Facture $facture
     * @return Paiement
     */
    public function setFacture(\chev\PensionBundle\Entity\Facture $facture = null)
    {
        $this->facture = $facture;
    
        return $this;
    }

    /**
     * Get facture
     *
     * @return \chev\PensionBundle\Entity\Facture 
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set typePaiement
     *
     * @param \chev\PensionBundle\Entity\TypePaiement $typePaiement
     * @return Paiement
     */
    public function setTypePaiement(\chev\PensionBundle\Entity\TypePaiement $typePaiement = null)
    {
        $this->typePaiement = $typePaiement;
    
        return $this;
    }

    /**
     * Get typePaiement
     *
     * @return \chev\PensionBundle\Entity\TypePaiement 
     */
    public function getTypePaiement()
    {
        return $this->typePaiement;
    }
}