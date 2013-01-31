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
     * @ORM\Column(name="dateDebut", type="datetime")
	 * @Assert\NotBlank()
	 * @Assert\DateTime(message="La date et l'heure doit être au format DD/MM/YYYY HH:MM")
     */	
    private $dateDebut;

	 /**
     * @var \DateTime $dateFin
     *
     * @ORM\Column(name="dateFin", type="datetime")
	 * @Assert\NotBlank()
	 * @Assert\DateTime(message="La date et l'heure doit être au format DD/MM/YYYY HH:MM")
     */
    private $dateFin;

	 /**
     * @var \DateTime $dateFacture
     *
     * @ORM\Column(name="dateFacture", type="datetime")
	 * @Assert\NotBlank()
	 * @Assert\DateTime(message="La date et l'heure doit être au format DD/MM/YYYY HH:MM")
     */	
    private $dateFacture;

	/**
     * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Cheval")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
	 */
	private $cheval;

	/**
	 * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Box")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
	 */
	private $box;
		
	/**
	 * @ORM\ManyToOne(targetEntity="s4a\UserBundle\Entity\User")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
	 */
	private $utilisateur;
	
	public function __construct()
	{
		$this->dateDebut = new \DateTime();
		$this->dateFin = new \DateTime();
		$this->dateFacture = new \DateTime();
	}

    public function __toString() {
        return (string)$this->id;
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

    /**
     * Set box
     *
     * @param \chev\BoxBundle\Entity\Box $box
     * @return Facture
     */
    public function setBox(\chev\BoxBundle\Entity\Box $box = null)
    {
        $this->box = $box;
    
        return $this;
    }

    /**
     * Get box
     *
     * @return \chev\BoxBundle\Entity\Box 
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * Set utilisateur
     *
     * @param \s4a\UserBundle\Entity\User $utilisateur
     * @return Facture
     */
    public function setUtilisateur(\s4a\UserBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \s4a\UserBundle\Entity\User 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}