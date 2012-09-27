<?php

namespace Site\Entity;

use Doctrine\ORM\Mapping AS ORM;
use DysBase\Entity\AbstractEntity;

/**
 * @package    Model
 * @version
 * @ORM\Entity
 * @ORM\Table(name="site")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Site extends AbstractEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="\Locale\Entity\Language")
     * @ORM\JoinColumn(
     *     name="idLangue",
     *     referencedColumnName="idLangue",
     *     onDelete="cascade"
     * )
     */
    protected $langue = null;

     /**
     * @ORM\OneToMany(targetEntity="Site\Entity\Site", mappedBy="_reference")
     */
    protected $slaves;

    /**
     * @ORM\ManyToOne(targetEntity="Site\Entity\Site", inversedBy="_slaves")
     * @ORM\JoinColumn(
     *     name="idSiteSynchroniser",
     *     referencedColumnName="id",
     *     onDelete="cascade"
     * )
     */
    protected $reference;

    /**
     * @var String
     * @ORM\Column(name="nom", type="string", length=128, nullable=false)
     */
    protected $nom;

    /**
     * @var Integer
     * @ORM\Column(name="defaut", type="boolean")
     */
    protected $defaut;


    public function __construct()
    {
        $this->slaves = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Retourne la langue
     * @return Locale_Model_Langue
     */
    public function getLangue()
    {
        return $this->langue;
    }
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setLangue($langue)
    {
        $this->langue = $langue;
    }
    public function getDefaut()
    {
        if ($this->defaut == 0)
            return false;
        else
            return true;
    }

    public function setDefaut($newVal)
    {
        $this->defaut = $newVal;
    }

    /**
     * Je renvoi le site a partir duquel celui ci est synchronisé
     * @return Site
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * j'affecte au champs _reference une reference
     * @param Site_Model_Site $reference
     * @return void
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }
    /**
     *
     * @return array site slave d'un site master
     */
    public function getSlaves()
    {
        return $this->slaves;
    }

    /**
     * @param array Site_Model_Site
     */
    public function setSlaves($siteSlaves)
    {
        $this->slaves = $siteSlaves;
    }
}