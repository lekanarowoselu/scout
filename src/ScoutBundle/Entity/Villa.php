<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Villa
 *
 * @ORM\Table(name="villa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VillaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Villa
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * @ORM\Column(name="price_terms", type="string", length=255)
     */
    private $price_terms;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;


    /**
     * @var int
     *
     * @ORM\Column(name="number_of_rooms", type="integer")
     */
    private $numberOfRooms;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     */
    private $description;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;
    /**
     * @var pageCategory
     *
     * @ORM\ManyToOne(targetEntity="VillaCategory", inversedBy="villas")
     * @ORM\JoinColumn(name="villa_category_id", referencedColumnName="id")
     */

   
    private $categories;

//    /**
//     * @ORM\OneToMany(targetEntity="Image", mappedBy="villa")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $images;



    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Slider")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id")
     */

    private $slider;

    /**
     * @ORM\ManyToMany(targetEntity="VillaService")
     * @ORM\JoinTable(name="villa_services",
     *      joinColumns={@ORM\JoinColumn(name="villa_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="villaservice_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $services;

    /**
     * @ORM\ManyToMany(targetEntity="VillaAmenity")
     * @ORM\JoinTable(name="villa_amenities",
     *      joinColumns={@ORM\JoinColumn(name="villa_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="villaamenity_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $amenities;

    /**
     * @ORM\ManyToMany(targetEntity="VillaSurfaceArea")
     * @ORM\JoinTable(name="villa_surfaceareas",
     *      joinColumns={@ORM\JoinColumn(name="villa_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="villasurfacearea_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $surface_areas;

    /**
     * @ORM\ManyToMany(targetEntity="VillaLocation")
     * @ORM\JoinTable(name="villa_locations",
     *      joinColumns={@ORM\JoinColumn(name="villa_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="villalocation_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $locations;

    /**
     * @ORM\OneToMany(targetEntity="VillaBooking", mappedBy="villa")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $bookings;


    /**
     * @ORM\ManyToMany(targetEntity="Villa")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="villa_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="villa_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="villas")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;


    /****************************************************/
//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    protected $images;

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
     * Set priceTerms
     *
     * @param string $priceTerms
     *
     * @return Villa
     */
    public function setPriceTerms($priceTerms)
    {
        $this->price_terms = $priceTerms;

        return $this;
    }

    /**
     * Get priceTerms
     *
     * @return string
     */
    public function getPriceTerms()
    {
        return $this->price_terms;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Villa
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Villa
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
     * @var int
     *
     * @ORM\Column(name="sorting", type="integer", nullable=true)
     */
    private $sorting;


    /**
    * Set createdAt
    *
    * @internal param \DateTime $createdAt
    * @return Villa
    * @ORM\PrePersist
    */
    public function setCreatedAt()
    {
        if(!isset($this->createdAt))
            $this->createdAt = new \DateTime();

        return $this;
    }


    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }



    /**
     * Set updatedAt
     *
     * @ORM\PrePersist
     * @internal param \DateTime $updatedAt
     * @return Villa
     */
    public function setUpdatedAt()
    {
        //$this->updatedAt = $updatedAt;
        $this->updatedAt = new \DateTime();

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }




    /**
     * Add category
     *
     * @param \AppBundle\Entity\VillaCategory $category
     *
     * @return Villa
     */
    public function addCategory(\AppBundle\Entity\VillaCategory $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\VillaCategory $category
     */
    public function removeCategory(\AppBundle\Entity\VillaCategory $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\VillaImage $image
     *
     * @return Villa
     */
    public function addImage(\AppBundle\Entity\VillaImage $image)
    {
        $this->images[] = $image;
        $image->setVilla($this);

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\VillaImage $image
     */
    public function removeImage(\AppBundle\Entity\VillaImage $image)
    {
        $this->images->removeElement($image);
        $image->setVilla(null);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add service
     *
     * @param \AppBundle\Entity\VillaService $service
     *
     * @return Villa
     */
    public function addService(\AppBundle\Entity\VillaService $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \AppBundle\Entity\VillaService $service
     */
    public function removeService(\AppBundle\Entity\VillaService $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add amenity
     *
     * @param \AppBundle\Entity\VillaAmenity $amenity
     *
     * @return Villa
     */
    public function addAmenity(\AppBundle\Entity\VillaAmenity $amenity)
    {
        $this->amenities[] = $amenity;

        return $this;
    }

    /**
     * Remove amenity
     *
     * @param \AppBundle\Entity\VillaAmenity $amenity
     */
    public function removeAmenity(\AppBundle\Entity\VillaAmenity $amenity)
    {
        $this->amenities->removeElement($amenity);
    }

    /**
     * Get amenities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAmenities()
    {
        return $this->amenities;
    }

    /**
     * Add surfaceArea
     *
     * @param \AppBundle\Entity\VillaSurfaceArea $surfaceArea
     *
     * @return Villa
     */
    public function addSurfaceArea(\AppBundle\Entity\VillaSurfaceArea $surfaceArea)
    {
        $this->surface_areas[] = $surfaceArea;

        return $this;
    }

    /**
     * Remove surfaceArea
     *
     * @param \AppBundle\Entity\VillaSurfaceArea $surfaceArea
     */
    public function removeSurfaceArea(\AppBundle\Entity\VillaSurfaceArea $surfaceArea)
    {
        $this->surface_areas->removeElement($surfaceArea);
    }

    /**
     * Get surfaceAreas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurfaceAreas()
    {
        return $this->surface_areas;
    }

    /**
     * Add location
     *
     * @param \AppBundle\Entity\VillaLocation $location
     *
     * @return Villa
     */
    public function addLocation(\AppBundle\Entity\VillaLocation $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \AppBundle\Entity\VillaLocation $location
     */
    public function removeLocation(\AppBundle\Entity\VillaLocation $location)
    {
        $this->locations->removeElement($location);
    }

    /**
     * Get locations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Add booking
     *
     * @param \AppBundle\Entity\VillaBooking $booking
     *
     * @return Villa
     */
    public function addBooking(\AppBundle\Entity\VillaBooking $booking)
    {
        $this->bookings[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \AppBundle\Entity\VillaBooking $booking
     */
    public function removeBooking(\AppBundle\Entity\VillaBooking $booking)
    {
        $this->bookings->removeElement($booking);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return Villa
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * Get sorting
     *
     * @return int
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    public function __toString()
    {
        return $this->getTitle();
        //return $this->name ? $this->name : '';
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return Villa
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
     * @return Villa
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
     * Set region
     *
     * @param string $region
     *
     * @return Villa
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set numberOfRooms
     *
     * @param integer $numberOfRooms
     *
     * @return Villa
     */
    public function setNumberOfRooms($numberOfRooms)
    {
        $this->numberOfRooms = $numberOfRooms;

        return $this;
    }

    /**
     * Get numberOfRooms
     *
     * @return integer
     */
    public function getNumberOfRooms()
    {
        return $this->numberOfRooms;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Villa
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
     * @param \AppBundle\Entity\Villa $translation
     *
     * @return Villa
     */
    public function addTranslation(\AppBundle\Entity\Villa $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \AppBundle\Entity\Villa $translation
     */
    public function removeTranslation(\AppBundle\Entity\Villa $translation)
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
     * @return Villa
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->amenities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->surface_areas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->locations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set slider
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return Villa
     */
    public function setSlider(\AppBundle\Entity\Slider $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }

    /**
     * Get slider
     *
     * @return \AppBundle\Entity\Slider
     */
    public function getSlider()
    {
        return $this->slider;
    }
}
