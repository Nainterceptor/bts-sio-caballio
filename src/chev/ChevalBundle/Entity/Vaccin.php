<?php

namespace chev\ChevalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\ChevalBundle\Entity\Vaccin
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\ChevalBundle\Entity\VaccinRepository")
 */
class Vaccin
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
     * @ORM\Column(name="libelle", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $libelle;

    /**
     * @var float $dosage
     *
     * @ORM\Column(name="dosage", type="float")
     * @Assert\NotBlank()
     */
    private $dosage;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $marque
     *
     * @ORM\Column(name="marque", type="string", length=50)
     */
    private $marque;


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
     * @return Vaccin
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
     * Set dosage
     *
     * @param float $dosage
     * @return Vaccin
     */
    public function setDosage($dosage)
    {
        $this->dosage = $dosage;
    
        return $this;
    }

    /**
     * Get dosage
     *
     * @return float 
     */
    public function getDosage()
    {
        return $this->dosage;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Vaccin
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
     * Set marque
     *
     * @param string $marque
     * @return Vaccin
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    
        return $this;
    }

    /**
     * Get marque
     *
     * @return string 
     */
    public function getMarque()
    {
        return $this->marque;
    }
}