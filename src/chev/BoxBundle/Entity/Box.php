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
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Centre")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $centre;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $date;

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
        return $this->centre->getNom().' - '.$this->id;
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
     * Set date
     *
     * @param \DateTime $date
     * @return Box
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
     * Set centre
     *
     * @param chev\BoxBundle\Entity\Centre $centre
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
     * @return chev\BoxBundle\Entity\Centre 
     */
    public function getCentre()
    {
        return $this->centre;
    }

    /**
     * Set type
     *
     * @param chev\BoxBundle\Entity\TypeBox $type
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
     * @return chev\BoxBundle\Entity\TypeBox 
     */
    public function getType()
    {
        return $this->type;
    }
}