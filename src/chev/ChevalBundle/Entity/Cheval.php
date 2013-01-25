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
     * @Assert\MaxLength(limit=100, message="Le nom doit comporter {{ limit }} caractères maximum")
     */
    private $nom;

    /**
     *
     * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Race")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $race;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $date;

    /**
     *
     * @ORM\ManyToOne(targetEntity="s4a\UserBundle\Entity\User")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $proprietaire;
       	
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
}