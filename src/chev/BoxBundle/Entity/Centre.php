<?php

namespace chev\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chev\ChevalBundle\Entity\Centre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\BoxBundle\Entity\CentreRepository")
 */
class Centre
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
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string $adresse
     *
     * @ORM\Column(name="adresse", type="string", length=100)
     */
    private $adresse;

    /**
     * @var string $codePostal
     *
     * @ORM\Column(name="codePostal", type="string", length=5)
     */
    private $codePostal;

    /**
     * @var string $ville
     *
     * @ORM\Column(name="ville", type="string", length=50)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="s4a\UserBundle\Entity\User")
	 * @ORM\JoinColumn()
     */
    private $gerant;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
		$this->date = new \DateTime();
	 }
	 
	/**
	 * toString du centre
	 * 
	 * @return nom
	 */
	 public function __toString()
	 {
	 	return $this->nom;
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
     * Set nom
     *
     * @param string $nom
     * @return Centre
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Centre
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     * @return Centre
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    
        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Centre
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Centre
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
     * @return Centre
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
     * Set gerant
     *
     * @param s4a\UserBundle\Entity\User $gerant
     * @return Centre
     */
    public function setGerant(\s4a\UserBundle\Entity\User $gerant = null)
    {
        $this->gerant = $gerant;
    
        return $this;
    }

    /**
     * Get gerant
     *
     * @return s4a\UserBundle\Entity\User 
     */
    public function getGerant()
    {
        return $this->gerant;
    }
}