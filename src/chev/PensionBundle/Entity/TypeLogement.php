<?php

namespace chev\PensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TypeLogement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\PensionBundle\Entity\TypeLogementRepository")
 */
class TypeLogement
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=150)
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit=150, message="Le libellé doit comporter {{ limit }} caractères maximum")
     */
    private $libelle;

    /**
     * @var float $prix
     *
     * @ORM\Column(name="prix", type="float")
     * @Assert\NotBlank()
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Centre")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $centre;

    /**
     * @var \DateTime $dateAjout
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    private $dateAjout;
	
	/**
     * @ORM\OneToMany(targetEntity="chev\PensionBundle\Entity\Facture", mappedBy="typeLogement")
     */
    protected $factures;
	
	public function __construct()
	{
		$this->dateAjout = new \DateTime;
	}
	
	public function __toString()
	{
		return(string) '"'.$this->libelle.'" - '.$this->prix.' €';
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
     * Get factures
     *
     * @return factures 
     */
    public function getFactures()
    {
        return $this->factures;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return TypeLogement
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
     * Set prix
     *
     * @param float $prix
     * @return TypeLogement
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TypeLogement
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return TypeLogement
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
     * Set centre
     *
     * @param \chev\BoxBundle\Entity\Centre $centre
     * @return TypeLogement
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