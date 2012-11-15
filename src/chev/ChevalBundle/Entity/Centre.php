<?php

namespace chev\ChevalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chev\ChevalBundle\Entity\Centre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="chev\ChevalBundle\Entity\CentreRepository")
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
}
