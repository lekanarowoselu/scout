<?php

namespace ScoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Lang
 *
 * @ORM\Table(name="lang")
 * @ORM\Entity(repositoryClass="scoutBundle\Repository\LangRepository")
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
     * @ORM\OneToMany(targetEntity="House", mappedBy="lang")
     */
    private $houses;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="HouseAmenity", mappedBy="lang")
     */
    private $houseAmenities;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="HouseCategory", mappedBy="lang")
     */
    private $houseCategories;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="HouseLocation", mappedBy="lang")
     */
    private $houseLocations;


//    /**
//     * @var ArrayCollection
//     *
//     * @ORM\OneToMany(targetEntity="HouseService", mappedBy="lang")
//     */
//    private $houseServices;
//
//
//    /**
//     * @var ArrayCollection
//     *
//     * @ORM\OneToMany(targetEntity="HouseSurfaceArea", mappedBy="lang")
//     */
//    private $houseSurfaceAreas;
//


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
     * @param \ScoutBundle\Entity\PageCategory $pageCategory
     *
     * @return Lang
     */
    public function addPageCategory(\ScoutBundle\Entity\PageCategory $pageCategory)
    {
        $this->pageCategories[] = $pageCategory;

        return $this;
    }

    /**
     * Remove pageCategory
     *
     * @param \ScoutBundle\Entity\PageCategory $pageCategory
     */
    public function removePageCategory(\ScoutBundle\Entity\PageCategory $pageCategory)
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
     * @param \ScoutBundle\Entity\Page $page
     *
     * @return Lang
     */
    public function addPage(\ScoutBundle\Entity\Page $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \ScoutBundle\Entity\Page $page
     */
    public function removePage(\ScoutBundle\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Add setting
     *
     * @param \ScoutBundle\Entity\Settings $setting
     *
     * @return Lang
     */
    public function addSetting(\ScoutBundle\Entity\Settings $setting)
    {
        $this->settings[] = $setting;

        return $this;
    }

    /**
     * Remove setting
     *
     * @param \ScoutBundle\Entity\Settings $setting
     */
    public function removeSetting(\ScoutBundle\Entity\Settings $setting)
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
     * @param \ScoutBundle\Entity\Slider $slider
     *
     * @return Lang
     */
    public function addSlider(\ScoutBundle\Entity\Slider $slider)
    {
        $this->sliders[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param \ScoutBundle\Entity\Slider $slider
     */
    public function removeSlider(\ScoutBundle\Entity\Slider $slider)
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
     * Add house
     *
     * @param \ScoutBundle\Entity\House $house
     *
     * @return Lang
     */
    public function addHouse(\ScoutBundle\Entity\House $house)
    {
        $this->houses[] = $house;

        return $this;
    }

    /**
     * Remove house
     *
     * @param \ScoutBundle\Entity\House $house
     */
    public function removeHouse(\ScoutBundle\Entity\House $house)
    {
        $this->houses->removeElement($house);
    }

    /**
     * Get houses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouses()
    {
        return $this->houses;
    }

    /**
     * Add houseAmenity
     *
     * @param \ScoutBundle\Entity\HouseAmenity $houseAmenity
     *
     * @return Lang
     */
    public function addHouseAmenity(\ScoutBundle\Entity\HouseAmenity $houseAmenity)
    {
        $this->houseAmenities[] = $houseAmenity;

        return $this;
    }

    /**
     * Remove houseAmenity
     *
     * @param \ScoutBundle\Entity\HouseAmenity $houseAmenity
     */
    public function removeHouseAmenity(\ScoutBundle\Entity\HouseAmenity $houseAmenity)
    {
        $this->houseAmenities->removeElement($houseAmenity);
    }

    /**
     * Get houseAmenities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouseAmenities()
    {
        return $this->houseAmenities;
    }

    /**
     * Add houseCategory
     *
     * @param \ScoutBundle\Entity\HouseCategory $houseCategory
     *
     * @return Lang
     */
    public function addHouseCategory(\ScoutBundle\Entity\HouseCategory $houseCategory)
    {
        $this->houseCategories[] = $houseCategory;

        return $this;
    }

    /**
     * Remove houseCategory
     *
     * @param \ScoutBundle\Entity\HouseCategory $houseCategory
     */
    public function removeHouseCategory(\ScoutBundle\Entity\HouseCategory $houseCategory)
    {
        $this->houseCategories->removeElement($houseCategory);
    }

    /**
     * Get houseCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouseCategories()
    {
        return $this->houseCategories;
    }

    /**
     * Add houseLocation
     *
     * @param \ScoutBundle\Entity\HouseLocation $houseLocation
     *
     * @return Lang
     */
    public function addHouseLocation(\ScoutBundle\Entity\HouseLocation $houseLocation)
    {
        $this->houseLocations[] = $houseLocation;

        return $this;
    }

    /**
     * Remove houseLocation
     *
     * @param \ScoutBundle\Entity\HouseLocation $houseLocation
     */
    public function removeHouseLocation(\ScoutBundle\Entity\HouseLocation $houseLocation)
    {
        $this->houseLocations->removeElement($houseLocation);
    }

    /**
     * Get houseLocations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouseLocations()
    {
        return $this->houseLocations;
    }

//    /**
//     * Add houseService
//     *
//     * @param \ScoutBundle\Entity\HouseService $houseService
//     *
//     * @return Lang
//     */
//    public function addHouseService(\ScoutBundle\Entity\HouseService $houseService)
//    {
//        $this->houseServices[] = $houseService;
//
//        return $this;
//    }
//
//    /**
//     * Remove houseService
//     *
//     * @param \ScoutBundle\Entity\HouseService $houseService
//     */
//    public function removeHouseService(\ScoutBundle\Entity\HouseService $houseService)
//    {
//        $this->houseServices->removeElement($houseService);
//    }
//
//    /**
//     * Get houseServices
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getHouseServices()
//    {
//        return $this->houseServices;
//    }
//
//
//
//    /**
//     * Add houseSurfaceArea
//     *
//     * @param \ScoutBundle\Entity\HouseSurfaceArea $houseSurfaceArea
//     *
//     * @return Lang
//     */
//    public function addHouseSurfaceArea(\ScoutBundle\Entity\HouseSurfaceArea $houseSurfaceArea)
//    {
//        $this->houseSurfaceAreas[] = $houseSurfaceArea;
//
//        return $this;
//    }
//
//    /**
//     * Remove houseSurfaceArea
//     *
//     * @param \ScoutBundle\Entity\HouseSurfaceArea $houseSurfaceArea
//     */
//    public function removeHouseSurfaceArea(\ScoutBundle\Entity\HouseSurfaceArea $houseSurfaceArea)
//    {
//        $this->houseSurfaceAreas->removeElement($houseSurfaceArea);
//    }
//
//    /**
//     * Get houseSurfaceArea
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getHouseSurfaceAreas()
//    {
//        return $this->houseSurfaceAreas;
//    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pageCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->settings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sliders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->houses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->houseAmenities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->houseCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->houseLocations = new \Doctrine\Common\Collections\ArrayCollection();
       // $this->houseServices = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->houseSurfaceAreas = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
