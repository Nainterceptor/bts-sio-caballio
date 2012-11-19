<?php

namespace chev\PensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pension
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\PensionBundle\Entity\PensionRepository")
 */
class Pension
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
	 * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Cheval")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $cheval;

    /**
     * @ORM\ManyToOne(targetEntity="s4a\UserBundle\Entity\User")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="chev\BoxBundle\Entity\Box")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $box;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
	 * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
	 * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $dateFin;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Pension
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Pension
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set cheval
     *
     * @param \chev\ChevalBundle\Entity\Cheval $cheval
     * @return Pension
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

    /**
     * Set client
     *
     * @param \s4a\UserBundle\Entity\User $client
     * @return Pension
     */
    public function setClient(\s4a\UserBundle\Entity\User $client = null)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return \s4a\UserBundle\Entity\User 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set box
     *
     * @param \chev\BoxBundle\Entity\Box $box
     * @return Pension
     */
    public function setBox(\chev\BoxBundle\Entity\Box $box = null)
    {
        $this->box = $box;
    
        return $this;
    }

    /**
     * Get box
     *
     * @return \chev\BoxBundle\Entity\Box 
     */
    public function getBox()
    {
        return $this->box;
    }
}