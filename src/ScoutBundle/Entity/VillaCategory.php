<?php

namespace ScoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Category
 *
 * @ORM\Table(name="villa_category", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="villa_category_title_idx", columns={"name", "lang_id"}),
 *     @ORM\UniqueConstraint(name="villa_category_slug_idx", columns={"slug", "lang_id"}),
 *     @ORM\UniqueConstraint(name="villa_category_meta_title_idx", columns={"meta_title", "lang_id"})
 *     })
 *
 * @UniqueEntity("name")
 * @UniqueEntity("slug")
 *
 * @UniqueEntity("metaTitle")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\VillaCategoryRepository")
 */
class VillaCategory
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

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
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */


    private $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Villa", mappedBy="categories")
     */
    private $villas;

    /**
     * @ORM\ManyToMany(targetEntity="VillaCategory")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="villaCategory_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="villaCategory_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="villaCategories")
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
     * Set slug
     *
     * @param string $slug
     *
     * @return VillaCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return VillaCategory
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
     * @return VillaCategory
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
     * Add villa
     *
     * @param \ScoutBundle\Entity\Villa $villa
     *
     * @return VillaCategory
     */
    public function addVilla(\ScoutBundle\Entity\Villa $villa)
    {
        $this->villas[] = $villa;

        return $this;
    }

    /**
     * Remove villa
     *
     * @param \ScoutBundle\Entity\Villa $villa
     */
    public function removeVilla(\ScoutBundle\Entity\Villa $villa)
    {
        $this->villas->removeElement($villa);
    }

    /**
     * Get villas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVillas()
    {
        return $this->villas;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return VillaCategory
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
     * @return VillaCategory
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

    public function __toString()
    {
       return $this->getName();
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return VillaCategory
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Add translation
     *
     * @param \ScoutBundle\Entity\VillaCategory $translation
     *
     * @return VillaCategory
     */
    public function addTranslation(\ScoutBundle\Entity\VillaCategory $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \ScoutBundle\Entity\VillaCategory $translation
     */
    public function removeTranslation(\ScoutBundle\Entity\VillaCategory $translation)
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
     * @return VillaCategory
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
        $this->villas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
