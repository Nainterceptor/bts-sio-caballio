<?php

namespace chev\PensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var \DateTime $dateDebut
     *
     * @ORM\Column(name="dateDebut", type="date")
	 * @Assert\NotBlank()
	 * @Assert\Date()
     */	
    private $dateDebut;

	 /**
     * @var \DateTime $dateFin
     *
     * @ORM\Column(name="dateFin", type="date")
	 * @Assert\NotBlank()
	 * @Assert\Date()
     */
    private $dateFin;

	 /**
     * @var \DateTime $dateFacture
     *
     * @ORM\Column(name="dateFacture", type="datetime")
     */	
    private $dateFacture;

	/**
	 * @ORM\ManyToOne(targetEntity="chev\PensionBundle\Entity\TypeLogement")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
	 */
	private $typeLogement;
		
	/**
	 * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Cheval")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
	 */
	private $cheval;
	
	/**
     * @ORM\OneToMany(targetEntity="chev\PensionBundle\Entity\Paiement", mappedBy="facture")
     */
    protected $paiements;
	
	/**
     * @ORM\OneToMany(targetEntity="chev\PensionBundle\Entity\Supplement", mappedBy="facture")
     */
    protected $supplements;
	
	public function __construct()
	{
		$this->dateDebut = new \DateTime();
		$this->dateFin = new \DateTime();
		$this->dateFacture = new \DateTime();
	}

    public function __toString() {
        return (string) "n° ".$this->id. " : ".$this->cheval;
    }
    
	public function getRAP()
	{
		$interval = $moisTotal = 0;
		$interval = $this->dateDebut->diff($this->dateFin, true);
		if ($interval->days > 0) {
			if ($interval->d == 0)
				$moisTotal = $interval->m;
			else
				$moisTotal = $interval->m + 1;
		}
		$montantTVA = ($moisTotal*$this->typeLogement->getPrix()) * 1.196;
		$montantTVA = number_format($montantTVA, 2);
		
		$RAP = 0;
		foreach ($this->paiements as $paiement) {
			$RAP += $paiement->getMontant();
		}
		$RAP = $montantTVA - $RAP;
		if ($this->supplements != null) {
			foreach ($this->supplements as $supp) {
				$RAP += $supp->getPrix();
			}
		}
		
		return $RAP;
	}
	
	/**
     * Get paiements
     *
     * @return paiements 
     */
    public function getPaiements()
    {
        return $this->paiements;
    }
    
	/**
     * Get supplements
     *
     * @return supplements 
     */
    public function getSupplements()
    {
        return $this->supplements;
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Facture
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Facture
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set dateFacture
     *
     * @param \DateTime $dateFacture
     * @return Facture
     */
    public function setDateFacture($dateFacture)
    {
        $this->dateFacture = $dateFacture;
    
        return $this;
    }

    /**
     * Get dateFacture
     *
     * @return \DateTime 
     */
    public function getDateFacture()
    {
        return $this->dateFacture;
    }
	

    /**
     * Set typeLogement
     *
     * @param \chev\PensionBundle\Entity\TypeLogement $typeLogement
     * @return Facture
     */
    public function setTypeLogement(\chev\PensionBundle\Entity\TypeLogement $typeLogement = null)
    {
        $this->typeLogement = $typeLogement;
    
        return $this;
    }

    /**
     * Get typeLogement
     *
     * @return \chev\PensionBundle\Entity\TypeLogement 
     */
    public function getTypeLogement()
    {
        return $this->typeLogement;
    }

    /**
     * Set cheval
     *
     * @param \chev\ChevalBundle\Entity\Cheval $cheval
     * @return Facture
     */
    public function setCheval(\chev\ChevalBundle\Entity\Cheval $cheval = null)
    {
        $this->cheval = $cheval;
    
        return $this;
    }

    /**
     * Get cheval
     *
     * @return \chev\ChevalBundle\Entity\Cheval 
     */
    public function getCheval()
    {
        return $this->cheval;
    }
}