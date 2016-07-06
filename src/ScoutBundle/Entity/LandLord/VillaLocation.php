<?php
/**
 * Created by PhpStorm.
 * User: dev2
 * Date: 06/06/16
 * Time: 15:51
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * locations
 *
 * @ORM\Table(name="villa_location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VillaLocationRepository")
 */

class VillaLocation
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

//    /**
//     * @ORM\ManyToOne(targetEntity="Villa", inversedBy="locations")
//     * @ORM\JoinColumn(name="villa_id", referencedColumnName="id", nullable=false)
//     */
//    private $villa;

    /**
     * @ORM\ManyToMany(targetEntity="VillaLocation")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="villaLocation_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="villaLocation_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;


    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="villaLocations")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;


    /****************************************************/


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
     * @return VillaLocation
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
     * @return VillaLocation
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
     * @param \AppBundle\Entity\Villa $villa
     *
     * @return VillaLocation
     */
    public function setVilla(\AppBundle\Entity\Villa $villa)
    {
        $this->villa = $villa;

        return $this;
    }

    /**
     * Get villa
     *
     * @return \AppBundle\Entity\Villa
     */
    public function getVilla()
    {
        return $this->villa;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return VillaLocation
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
     * @return VillaLocation
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
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add translation
     *
     * @param \AppBundle\Entity\VillaLocation $translation
     *
     * @return VillaLocation
     */
    public function addTranslation(\AppBundle\Entity\VillaLocation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \AppBundle\Entity\VillaLocation $translation
     */
    public function removeTranslation(\AppBundle\Entity\VillaLocation $translation)
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
     * @param \AppBundle\Entity\Lang $lang
     *
     * @return VillaLocation
     */
    public function setLang(\AppBundle\Entity\Lang $lang = null)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return \AppBundle\Entity\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }
}
