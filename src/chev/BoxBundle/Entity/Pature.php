<?php

namespace chev\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\BoxBundle\Entity\Pature
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\BoxBundle\Entity\PatureRepository")
 */
class Pature
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
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var float $taille
     *
     * @ORM\Column(name="taille", type="float")
     */
    private $taille;

    /**
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Centre")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $centre;

    /**
     * @var boolean $utilise
     *
     * @ORM\Column(name="utilise", type="boolean")
     */
    private $utilise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
	
	/**
	 * Constructeur de pature
	 */
	 public function __construct()
	 {
		$this->date = new \DateTime();
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
     * Set libelle
     *
     * @param string $libelle
     * @return Pature
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
     * Set taille
     *
     * @param float $taille
     * @return Pature
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
    
        return $this;
    }

    /**
     * Get taille
     *
     * @return float 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set utilise
     *
     * @param boolean $utilise
     * @return Pature
     */
    public function setUtilise($utilise)
    {
        $this->utilise = $utilise;
    
        return $this;
    }

    /**
     * Get utilise
     *
     * @return boolean 
     */
    public function getUtilise()
    {
        return $this->utilise;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Pature
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set centre
     *
     * @param \chev\BoxBundle\Entity\Centre $centre
     * @return Pature
     */
    public function setCentre(\chev\BoxBundle\Entity\Centre $centre = null)
    {
        $this->centre = $centre;
    
        return $this;
    }

    /**
     * Get centre
     *
     * @return \chev\BoxBundle\Entity\Centre 
     */
    public function getCentre()
    {
        return $this->centre;
    }
}