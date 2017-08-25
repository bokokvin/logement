<?php

namespace BK\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="BK\PlatformBundle\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	
	
	/**
     * @ORM\ManyToOne(targetEntity="BK\PlatformBundle\Entity\Category", inversedBy="annonces", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
  /*  private $category;*/
	
	
	/**
   * @ORM\ManyToOne(targetEntity="BK\UserBundle\Entity\User", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
	private $user;
	
	/**
   * @ORM\OneToOne(targetEntity="BK\PlatformBundle\Entity\Image", cascade={"persist"})
   */
    private $image;
	
	
    /**
     * @var string
     *
     * @ORM\Column(name="detenteur", type="string", length=255)
     */
    private $detenteur;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
     protected $date;
	 
	 public function __construct()
    {
        $this->date = new \DateTime();
    }
	

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
	
	/**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;


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
     * Set detenteur
     *
     * @param string $detenteur
     * @return Annonce
     */
    public function setDetenteur($detenteur)
    {
        $this->detenteur = $detenteur;

        return $this;
    }

    /**
     * Get detenteur
     *
     * @return string 
     */
    public function getDetenteur()
    {
        return $this->detenteur;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Annonce
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return Annonce
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Annonce
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
     * Set adresse
     *
     * @param string $adresse
     * @return Annonce
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
     * Set user
     *
     * @param \BK\UserBundle\Entity\User $user
     * @return Annonce
     */
    public function setUser(\BK\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BK\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
	
	
	/**
     * Set image
     *
     * @param \BK\PlatformBundle\Entity\Image $image
     * @return Annonce
     */
	public function setImage(Image $image = null)
	{
		$this->image = $image;
	}

	
	/**
     * Get image
     *
     * @return \BK\PlatformBundle\Entity\Image 
     */
	public function getImage()
	{
		return $this->image;
	}
	
	
	/**
     * Set category
     *
     * @param \BK\PlatformBundle\Entity\Category $category
     * @return Annonce
     */
/*	public function setCategory(Category $category)
	{
		$this->category = $category;
	}*/

	
	/**
     * Get category
     *
     * @return \BK\PlatformBundle\Entity\Category 
     */
/*	public function getCategory()
	{
		return $this->category;
	}*/
	
	
	
	

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Annonce
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
     * Set category
     *
     * @param string $category
     * @return Annonce
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
