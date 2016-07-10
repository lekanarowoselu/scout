<?php

namespace ScoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * House
 *
 * @ORM\Table(name="house")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\HouseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class House
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

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
     * @ORM\Column(name="description", type="text")
     *
     */
    
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="how_to_apply", type="text")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="price_terms", type="string", length=255)
     */
    private $price_terms;



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
     * @ORM\ManyToOne(targetEntity="Landlord", inversedBy="houses")
     * @ORM\JoinColumn(name="landlord_id", referencedColumnName="id", nullable=false)
     */
    private $landlord;


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
     * @ORM\ManyToOne(targetEntity="HouseLocation", inversedBy="houses")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", nullable=false)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="rooms")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $rooms;

    

    /**
     * @ORM\OneToOne(targetEntity="ScoutBundle\Entity\Slider")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id")
     */

    private $slider;

    

    /**
     * @ORM\ManyToMany(targetEntity="HouseAmenity")
     * @ORM\JoinTable(name="house_amenities",
     *      joinColumns={@ORM\JoinColumn(name="house_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="houseaamenity_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $amenities;

    /**
     * @ORM\ManyToMany(targetEntity="HouseLocation")
     * @ORM\JoinTable(name="house_locations",
     *      joinColumns={@ORM\JoinColumn(name="house_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="houselocation_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $locations;

    /**
     * @ORM\OneToMany(targetEntity="HouseBooking", mappedBy="house")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $bookings;


    /**
     * @ORM\ManyToMany(targetEntity="House")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="house_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="house_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="housess")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set type
     *
     * @param string $type
     *
     * @return house
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
     * Set title
     *
     * @param string $title
     *
     * @return house
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
     * @return house
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
     * Set createdAt
     *
     * @internal param \DateTime $createdAt
     * @return house
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
     * @return house
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
     * Add application
     *
     * @param \ScoutBundle\Entity\Agent\Room $room
     *
     * @return House
     */
    public function addRoom(\ScoutBundle\Entity\Agent\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \ScoutBundle\Entity\Agent\Room $room
     */
    public function removeRoom(\ScoutBundle\Entity\Agent\Room $room)
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }


    /**
     * Add category
     *
     * @param \ScoutBundle\Entity\Agent\HouseAmenity $amenity
     *
     * @return house
     */
    public function addAmenity(\ScoutBundle\Entity\Agent\HouseAmenity $amenity)
    {
        $this->amenities[] = $amenity;

        return $this;
    }
    


    /**
     * Remove amenity
     *
     * @param \ScoutBundle\Entity\Agent\HouseAmenity $amenity
     */
    public function removeAmenity(\ScoutBundle\Entity\Agent\HouseAmenity $amenity)
    {
        $this->amenities->removeElement($amenity);
    }


   
  
        public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return House
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
     * @return House
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
     * Set address
     *
     * @param string $address
     *
     * @return House
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set priceTerms
     *
     * @param string $priceTerms
     *
     * @return House
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
     * Set region
     *
     * @param string $region
     *
     * @return House
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
     * @return House
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
     * @return House
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
     * Set landlord
     *
     * @param \ScoutBundle\Entity\LandLord $landlord
     *
     * @return House
     */
    public function setLandlord(\ScoutBundle\Entity\LandLord $landlord)
    {
        $this->landlord = $landlord;

        return $this;
    }

    /**
     * Get landlord
     *
     * @return \ScoutBundle\Entity\LandLord
     */
    public function getLandlord()
    {
        return $this->landlord;
    }

    /**
     * Set location
     *
     * @param \ScoutBundle\Entity\Location $location
     *
     * @return House
     */
    public function setLocation(\ScoutBundle\Entity\Location $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \ScoutBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set slider
     *
     * @param \ScoutBundle\Entity\Slider $slider
     *
     * @return House
     */
    public function setSlider(\ScoutBundle\Entity\Slider $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }

    /**
     * Get slider
     *
     * @return \ScoutBundle\Entity\Slider
     */
    public function getSlider()
    {
        return $this->slider;
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
     * Add location
     *
     * @param \ScoutBundle\Entity\HouseLocation $location
     *
     * @return House
     */
    public function addLocation(\ScoutBundle\Entity\HouseLocation $location)
    {
        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \ScoutBundle\Entity\HouseLocation $location
     */
    public function removeLocation(\ScoutBundle\Entity\HouseLocation $location)
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
     * @param \ScoutBundle\Entity\HouseBooking $booking
     *
     * @return House
     */
    public function addBooking(\ScoutBundle\Entity\HouseBooking $booking)
    {
        $this->bookings[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \ScoutBundle\Entity\HouseBooking $booking
     */
    public function removeBooking(\ScoutBundle\Entity\Housebooking $booking)
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
     * Add translation
     *
     * @param \ScoutBundle\Entity\House $translation
     *
     * @return House
     */
    public function addTranslation(\ScoutBundle\Entity\House $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \ScoutBundle\Entity\House$translation
     */
    public function removeTranslation(\ScoutBundle\Entity\House $translation)
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
     * @return House
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
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->amenities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->locations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
