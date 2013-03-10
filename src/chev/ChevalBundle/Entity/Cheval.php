<?php

namespace chev\ChevalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\ChevalBundle\Entity\Cheval
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\ChevalBundle\Entity\ChevalRepository")
 */
class Cheval
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
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit=50, message="Le nom doit comporter {{ limit }} caractères maximum")
     */
    private $nom;

    /**
     *
     * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Race")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $race;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="s4a\UserBundle\Entity\User")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $proprietaire;
    
    /**
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Centre")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
	 */
    private $centre;
	
	/**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=1000)
     * @Assert\MaxLength(limit=1000, message="La description doit comporter {{ limit }} caractères maximum")
     */
	private $description;
	
	/**
     * @var string $sexe
     *
     * @ORM\Column(name="sexe", type="string", length=10)
     * @Assert\NotBlank()
     */
	private $sexe;
       	
    public function __construct() {
        $this->date = new \DateTime();
    }
	public function __toString() {
		return $this->id.'. '.$this->nom;
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
     * Set nom
     *
     * @param string $nom
     * @return Cheval
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Cheval
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
     * Set race
     *
     * @param chev\ChevalBundle\Entity\Race $race
     * @return Cheval
     */
    public function setRace(\chev\ChevalBundle\Entity\Race $race = null)
    {
        $this->race = $race;
    
        return $this;
    }

    /**
     * Get race
     *
     * @return chev\ChevalBundle\Entity\Race 
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set proprietaire
     *
     * @param s4a\UserBundle\Entity\User $proprietaire
     * @return Cheval
     */
    public function setProprietaire(\s4a\UserBundle\Entity\User $proprietaire = null)
    {
        $this->proprietaire = $proprietaire;
    
        return $this;
    }

    /**
     * Get proprietaire
     *
     * @return s4a\UserBundle\Entity\User 
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * Set centre
     *
     * @param \chev\BoxBundle\Entity\Centre $centre
     * @return Cheval
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
	

    /**
     * Set description
     *
     * @param string $description
     * @return Cheval
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Cheval
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }
}