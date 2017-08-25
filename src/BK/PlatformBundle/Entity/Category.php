<?php

namespace BK\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="BK\PlatformBundle\Repository\CategoryRepository")
 */
class Category
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
     * @var string
	 *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


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
     * @return Category
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
     * @ORM\OneToMany(targetEntity="BK\PlatformBundle\Entity\Annonce", mappedBy="category")
     */
    protected $annonces;
	
	public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }


    /**
     * Add annonces
     *
     * @param \BK\PlatformBundle\Entity\Annonce $annonces
     * @return Category
     */
    public function addAnnonce(\BK\PlatformBundle\Entity\Annonce $annonces)
    {
        $this->annonces[] = $annonces;

        return $this;
    }

    /**
     * Remove annonces
     *
     * @param \BK\PlatformBundle\Entity\Annonce $annonces
     */
    public function removeAnnonce(\BK\PlatformBundle\Entity\Annonce $annonces)
    {
        $this->annonces->removeElement($annonces);
    }

    /**
     * Get annonces
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }
	
	public function __toString() {
		return (string) $this->nom;

}

}
