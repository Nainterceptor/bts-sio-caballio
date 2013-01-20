<?php

namespace chev\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\BoxBundle\Entity\TypeBox
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\BoxBundle\Entity\TypeBoxRepository")
 */
class TypeBox
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
     * @ORM\Column(name="libelle", type="string", length=150)
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit=150, message="Le libellé doit comporter {{ limit }} caractères maximum")
     */
    private $libelle;

    /**
     * @var float $volume
     *
     * @ORM\Column(name="volume", type="decimal")
     * @Assert\NotBlank()
     */
    private $volume;

    /**
     * @var float $prix
     *
     * @ORM\Column(name="prix", type="float")
     * @Assert\NotBlank()
     */
    private $prix;
    
    /**
     * @var \DateTime $dateAjout
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    private $dateAjout;

    /**
     * Constructeur du centre
     */
     public function __construct()
     {
        $this->dateAjout = new \DateTime();
     }
     
    /**
     * toString du centre
     * 
     * @return nom
     */
     public function __toString()
     {
        return $this->libelle;
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
     * @return TypeBox
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
     * Set volume
     *
     * @param float $volume
     * @return TypeBox
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    
        return $this;
    }

    /**
     * Get volume
     *
     * @return float 
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return TypeBox
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return TypeBox
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
}