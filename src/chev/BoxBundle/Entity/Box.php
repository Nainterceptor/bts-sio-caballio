<?php

namespace chev\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\BoxBundle\Entity\Box
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\BoxBundle\Entity\BoxRepository")
 */
class Box
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
	 * @var integer $numero
	 * 
	 * @ORM\Column(name="numero", type="integer")
	 * @Assert\NotBlank()
	 */
	private $numero;

    /**
     * @var \DateTime $dateAjout
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    private $dateAjout;

    /**
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Centre")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $centre;
	
	/**
	 * @ORM\OneToOne(targetEntity="chev\ChevalBundle\Entity\Cheval", mappedBy="box")
	 */
	protected $cheval;

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
     	if ($this->cheval == null) {
			 return(string) $this->numero . ', "Box vide"';
		 }
        return(string) $this->numero . '. '.'"'.$this->cheval->getNom().'"';
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Box
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
     * Get cheval
     *
     * @return cheval
     */
    public function getCheval()
    {
        return $this->cheval;
    }

    /**
     * Set centre
     *
     * @param \chev\BoxBundle\Entity\Centre $centre
     * @return Box
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
     * Set numero
     *
     * @param integer $numero
     * @return Box
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }
}