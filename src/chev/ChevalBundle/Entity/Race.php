<?php

namespace chev\ChevalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\ChevalBundle\Entity\Race
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\ChevalBundle\Entity\RaceRepository")
 */
class Race
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
     * @ORM\Column(name="libelle", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit=50, message="Le libelle de la race doit comporter {{ limit }} caractères maximum")
     */
    private $libelle;
	
	/**
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Centre")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
	 */
    private $centre;

    public function __toString() {
        return $this->id.'. '.$this->libelle;
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
     * @return Race
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
     * Set centre
     *
     * @param \chev\BoxBundle\Entity\Centre $centre
     * @return Race
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