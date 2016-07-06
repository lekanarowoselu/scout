<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Lang
 *
 * @ORM\Table(name="lang")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LangRepository")
 */
class Lang
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=10)
     */
    private $locale;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PageCategory", mappedBy="lang")
     */
    private $pageCategories;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Page", mappedBy="lang")
     */
    private $pages;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Settings", mappedBy="lang")
     */
    private $settings;



    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Slider", mappedBy="lang")
     */
    private $sliders;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Villa", mappedBy="lang")
     */
    private $villas;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="VillaAmenity", mappedBy="lang")
     */
    private $villaAmenities;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="VillaCategory", mappedBy="lang")
     */
    private $villaCategories;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="VillaLocation", mappedBy="lang")
     */
    private $villaLocations;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="VillaService", mappedBy="lang")
     */
    private $villaServices;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="VillaSurfaceArea", mappedBy="lang")
     */
    private $villaSurfaceAreas;
  


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
     * @return Lang
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
        return ucfirst($this->name);
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return Lang
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return ArrayCollection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param ArrayCollection $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    public function __toString()
    {
//        return $this->getName()."--".$this->getLocale();
        return $this->getLocale();
    }

    /**
     * Add pageCategory
     *
     * @param \AppBundle\Entity\PageCategory $pageCategory
     *
     * @return Lang
     */
    public function addPageCategory(\AppBundle\Entity\PageCategory $pageCategory)
    {
        $this->pageCategories[] = $pageCategory;

        return $this;
    }

    /**
     * Remove pageCategory
     *
     * @param \AppBundle\Entity\PageCategory $pageCategory
     */
    public function removePageCategory(\AppBundle\Entity\PageCategory $pageCategory)
    {
        $this->pageCategories->removeElement($pageCategory);
    }

    /**
     * Get pageCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPageCategories()
    {
        return $this->pageCategories;
    }

    /**
     * Add page
     *
     * @param \AppBundle\Entity\Page $page
     *
     * @return Lang
     */
    public function addPage(\AppBundle\Entity\Page $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \AppBundle\Entity\Page $page
     */
    public function removePage(\AppBundle\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Add setting
     *
     * @param \AppBundle\Entity\Settings $setting
     *
     * @return Lang
     */
    public function addSetting(\AppBundle\Entity\Settings $setting)
    {
        $this->settings[] = $setting;

        return $this;
    }

    /**
     * Remove setting
     *
     * @param \AppBundle\Entity\Settings $setting
     */
    public function removeSetting(\AppBundle\Entity\Settings $setting)
    {
        $this->settings->removeElement($setting);
    }

    /**
     * Get settings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Add slider
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return Lang
     */
    public function addSlider(\AppBundle\Entity\Slider $slider)
    {
        $this->sliders[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param \AppBundle\Entity\Slider $slider
     */
    public function removeSlider(\AppBundle\Entity\Slider $slider)
    {
        $this->sliders->removeElement($slider);
    }

    /**
     * Get sliders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSliders()
    {
        return $this->sliders;
    }

    /**
     * Add villa
     *
     * @param \AppBundle\Entity\Villa $villa
     *
     * @return Lang
     */
    public function addVilla(\AppBundle\Entity\Villa $villa)
    {
        $this->villas[] = $villa;

        return $this;
    }

    /**
     * Remove villa
     *
     * @param \AppBundle\Entity\Villa $villa
     */
    public function removeVilla(\AppBundle\Entity\Villa $villa)
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
     * Add villaAmenity
     *
     * @param \AppBundle\Entity\VillaAmenity $villaAmenity
     *
     * @return Lang
     */
    public function addVillaAmenity(\AppBundle\Entity\VillaAmenity $villaAmenity)
    {
        $this->villaAmenities[] = $villaAmenity;

        return $this;
    }

    /**
     * Remove villaAmenity
     *
     * @param \AppBundle\Entity\VillaAmenity $villaAmenity
     */
    public function removeVillaAmenity(\AppBundle\Entity\VillaAmenity $villaAmenity)
    {
        $this->villaAmenities->removeElement($villaAmenity);
    }

    /**
     * Get villaAmenities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVillaAmenities()
    {
        return $this->villaAmenities;
    }

    /**
     * Add villaCategory
     *
     * @param \AppBundle\Entity\VillaCategory $villaCategory
     *
     * @return Lang
     */
    public function addVillaCategory(\AppBundle\Entity\VillaCategory $villaCategory)
    {
        $this->villaCategories[] = $villaCategory;

        return $this;
    }

    /**
     * Remove villaCategory
     *
     * @param \AppBundle\Entity\VillaCategory $villaCategory
     */
    public function removeVillaCategory(\AppBundle\Entity\VillaCategory $villaCategory)
    {
        $this->villaCategories->removeElement($villaCategory);
    }

    /**
     * Get villaCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVillaCategories()
    {
        return $this->villaCategories;
    }

    /**
     * Add villaLocation
     *
     * @param \AppBundle\Entity\VillaLocation $villaLocation
     *
     * @return Lang
     */
    public function addVillaLocation(\AppBundle\Entity\VillaLocation $villaLocation)
    {
        $this->villaLocations[] = $villaLocation;

        return $this;
    }

    /**
     * Remove villaLocation
     *
     * @param \AppBundle\Entity\VillaLocation $villaLocation
     */
    public function removeVillaLocation(\AppBundle\Entity\VillaLocation $villaLocation)
    {
        $this->villaLocations->removeElement($villaLocation);
    }

    /**
     * Get villaLocations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVillaLocations()
    {
        return $this->villaLocations;
    }

    /**
     * Add villaService
     *
     * @param \AppBundle\Entity\VillaService $villaService
     *
     * @return Lang
     */
    public function addVillaService(\AppBundle\Entity\VillaService $villaService)
    {
        $this->villaServices[] = $villaService;

        return $this;
    }

    /**
     * Remove villaService
     *
     * @param \AppBundle\Entity\VillaService $villaService
     */
    public function removeVillaService(\AppBundle\Entity\VillaService $villaService)
    {
        $this->villaServices->removeElement($villaService);
    }

    /**
     * Get villaServices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVillaServices()
    {
        return $this->villaServices;
    }



    /**
     * Add villaSurfaceArea
     *
     * @param \AppBundle\Entity\VillaSurfaceArea $villaSurfaceArea
     *
     * @return Lang
     */
    public function addVillaSurfaceArea(\AppBundle\Entity\VillaSurfaceArea $villaSurfaceArea)
    {
        $this->villaSurfaceAreas[] = $villaSurfaceArea;

        return $this;
    }

    /**
     * Remove villaSurfaceArea
     *
     * @param \AppBundle\Entity\VillaSurfaceArea $villaSurfaceArea
     */
    public function removeVillaSurfaceArea(\AppBundle\Entity\VillaSurfaceArea $villaSurfaceArea)
    {
        $this->villaSurfaceAreas->removeElement($villaSurfaceArea);
    }

    /**
     * Get villaSurfaceArea
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVillaSurfaceAreas()
    {
        return $this->villaSurfaceAreas;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pageCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->settings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sliders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->villas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->villaAmenities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->villaCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->villaLocations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->villaServices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->villaSurfaceAreas = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
