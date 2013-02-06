<?php

namespace s4a\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="s4a\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
    /**
     * @var string $sex
     *
     * @ORM\Column(name="sex", type="boolean", nullable=true)
	 *
     */
    private $sex;
	
    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=75, nullable=true)
     * @Assert\NotBlank(message="Vous devez entrer un prénom.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="2", message="Ce prénom est trop court.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="75", message="Ce prénom est trop long.", groups={"Registration", "Profile"})
     */
    private $firstname;
    
    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=75, nullable=true )
     * @Assert\NotBlank(message="Vous devez entrer un nom.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="2", message="Ce nom est trop court.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="75", message="Ce nom est trop long.", groups={"Registration", "Profile"})
     */
    private $lastname;
    
    /**
     * @var string $adress
     *
     * @ORM\Column(name="adress", type="string", length=255, nullable=true)
     * @Assert\MinLength(limit="6", message="Cette adresse est trop courte.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="Cette adresse est trop longue.", groups={"Registration", "Profile"})
     */
    private $adress;
    
    /**
     * @var string $zipcode
     *
     * @ORM\Column(name="zipcode", type="string", length=15, nullable=true)
     * @Assert\MinLength(limit="5", message="Ce code postal est trop court.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="15", message="Ce code postal est trop long.", groups={"Registration", "Profile"})
     */
    private $zipcode;
    
    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=175, nullable=true)
     * @Assert\MinLength(limit="2", message="Cette ville est trop courte.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="175", message="Cette ville est trop longue.", groups={"Registration", "Profile"})
     */
    private $city;
    
    /**
     * @var string $email
     * @Assert\Email(
     *     message = "L'adresse '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     */
    protected $email;
    
    /**
     * @ORM\OneToMany(targetEntity="chev\PensionBundle\Entity\Facture", mappedBy="utilisateur")
     */
    protected $factures;
    	
	public function __construct() {
		parent::__construct();
	}
	public function __toString() {
		if(!empty($this->firstname) && !empty($this->lastname))
			return $this->firstname.' '.$this->lastname;
		else
			return parent::__toString();
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
     * Set sex
     *
     * @param boolean $sex
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return boolean 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return User
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    
        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

}