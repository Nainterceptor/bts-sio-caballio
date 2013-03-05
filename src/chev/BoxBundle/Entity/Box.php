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
     * @var \DateTime $dateAjout
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    private $dateAjout;

    /**
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\TypeBox")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $type;
	
	/**
	 * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Cheval")
	 * @ORM\JoinColumn()
	 */
	private $cheval;

    /**
     * Constructeur du centre
     */
     public function __construct()
     {
        $this->dateAjout = new \DateTime();
        $this->date = new \DateTime();
     }
     
    /**
     * toString du centre
     * 
     * @return nom
     */
     public function __toString()
     {
     	if ($this->cheval == null) {
			 return (string)$this->id . ', "Vide box"';
		 }
        return (string)$this->id . '. '.'"'.$this->cheval->getNom().'"';
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
     * Set type
     *
     * @param \chev\BoxBundle\Entity\TypeBox $type
     * @return Box
     */
    public function setType(\chev\BoxBundle\Entity\TypeBox $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return \chev\BoxBundle\Entity\TypeBox 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set cheval
     *
     * @param \chev\ChevalBundle\Entity\Cheval $cheval
     * @return Box
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
}