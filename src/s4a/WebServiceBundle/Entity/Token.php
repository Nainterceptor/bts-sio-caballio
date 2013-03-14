<?php

namespace s4a\WebServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Token
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="s4a\WebServiceBundle\Entity\TokenRepository")
 */
class Token
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
     * @ORM\ManyToOne(targetEntity="s4a\UserBundle\Entity\User")
	 * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
	 * @Assert\NotBlank()
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
	 * @Assert\NotBlank()
     */
    private $datetime;

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
     * Set token
     *
     * @param string $token
     * @return Token
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Token
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    
        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set user
     *
     * @param \s4a\UserBundle\Entity\User $user
     * @return Token
     */
    public function setUser(\s4a\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \s4a\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}