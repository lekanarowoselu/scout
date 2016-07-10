<?php

namespace ScoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Amenities
 *
 * @ORM\Table(name="villa_amenity")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\VillaAmenityRepository")
 */
class VillaAmenity
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
     * @ORM\Column(name="meta_title", type="string", length=255, unique=true)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=500)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */



    private $name;



    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Villa", inversedBy="amenities")
//     * @ORM\JoinColumn(name="villa_id", referencedColumnName="id", nullable=false)
//     */
//    private $villa;


    /**
     * @ORM\ManyToMany(targetEntity="VillaAmenity")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="villaAmenity_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="villaAmenity_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;
    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="villaAmenities")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;



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
     * Set name
     *
     * @param string $name
     *
     * @return VillaAmenity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return VillaAmenity
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set villa
     *
     * @param \ScoutBundle\Entity\Villa $villa
     *
     * @return VillaAmenity
     */
    public function setVilla(\ScoutBundle\Entity\Villa $villa)
    {
        $this->villa = $villa;

        return $this;
    }

    /**
     * Get villa
     *
     * @return \ScoutBundle\Entity\Villa
     */
    public function getVilla()
    {
        return $this->villa;
    }

    public function __toString()

    {
        return $this->getName();
    }



    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return VillaAmenity
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return VillaAmenity
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Add translation
     *
     * @param \ScoutBundle\Entity\VillaAmenity $translation
     *
     * @return VillaAmenity
     */
    public function addTranslation(\ScoutBundle\Entity\VillaAmenity $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \ScoutBundle\Entity\VillaAmenity $translation
     */
    public function removeTranslation(\ScoutBundle\Entity\VillaAmenity $translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set lang
     *
     * @param \ScoutBundle\Entity\Lang $lang
     *
     * @return VillaAmenity
     */
    public function setLang(\ScoutBundle\Entity\Lang $lang = null)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return \ScoutBundle\Entity\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
