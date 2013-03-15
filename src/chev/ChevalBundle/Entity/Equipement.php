<?php

namespace chev\ChevalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\ChevalBundle\Entity\Equipement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\ChevalBundle\Entity\EquipementRepository")
 */
class Equipement
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
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit=255, message="Le nom doit comporter {{ limit }} caractères maximum")
     */
    private $libelle;

    /**
     * @var \DateTime $dateAjout
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    private $dateAjout;

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
	
	public function __construct() {
        $this->dateAjout = new \DateTime();
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
     * @return Equipement
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Equipement
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    
        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime 
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }


    /**
     * Set proprietaire
     *
     * @param \s4a\UserBundle\Entity\User $proprietaire
     * @return Equipement
     */
    public function setProprietaire(\s4a\UserBundle\Entity\User $proprietaire = null)
    {
        $this->proprietaire = $proprietaire;
    
        return $this;
    }

    /**
     * Get proprietaire
     *
     * @return \s4a\UserBundle\Entity\User 
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * Set centre
     *
     * @param \chev\BoxBundle\Entity\Centre $centre
     * @return Equipement
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