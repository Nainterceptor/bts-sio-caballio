<?php

namespace chev\ChevalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * chev\ChevalBundle\Entity\Cheval_Vaccin
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\ChevalBundle\Entity\Cheval_VaccinRepository")
 */
class Cheval_Vaccin
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
     *
     * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Cheval")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $cheval;

    /**
     *
     * @ORM\ManyToOne(targetEntity="chev\ChevalBundle\Entity\Vaccin")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $vaccin;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $date;


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
     * @return Cheval_Vaccin
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
     * Set cheval
     *
     * @param chev\ChevalBundle\Entity\Cheval $cheval
     * @return Cheval_Vaccin
     */
    public function setCheval(\chev\ChevalBundle\Entity\Cheval $cheval = null)
    {
        $this->cheval = $cheval;
    
        return $this;
    }

    /**
     * Get cheval
     *
     * @return chev\ChevalBundle\Entity\Cheval 
     */
    public function getCheval()
    {
        return $this->cheval;
    }

    /**
     * Set vaccin
     *
     * @param chev\ChevalBundle\Entity\Vaccin $vaccin
     * @return Cheval_Vaccin
     */
    public function setVaccin(\chev\ChevalBundle\Entity\Vaccin $vaccin = null)
    {
        $this->vaccin = $vaccin;
    
        return $this;
    }

    /**
     * Get vaccin
     *
     * @return chev\ChevalBundle\Entity\Vaccin 
     */
    public function getVaccin()
    {
        return $this->vaccin;
    }
}