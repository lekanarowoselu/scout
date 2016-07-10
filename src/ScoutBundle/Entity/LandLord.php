<?php

namespace ScoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * LandLord
 *
 * @ORM\Table(name="landlord")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\LandLordRepository")
 *
 * @ORM\HasLifecycleCallbacks
 *
 */
class LandLord
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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", unique=true)
     */


    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="website_url", type="string", length=255, nullable=true, unique=true)
     */
    private $websiteUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=255, unique=true)
     */
    private $contactEmail;

    /**
     * @ORM\OneToOne(targetEntity="AuthBundle\Entity\User", inversedBy="landlord")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */

    private $user;


//    /**
//     * @ORM\OneToMany(targetEntity="Application", mappedBy="company")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $applications;

    /**
     * @ORM\OneToMany(targetEntity="House", mappedBy="landlord")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $houses;



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
     * Set name
     *
     * @param string $name
     *
     * @return LandLord
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
     * @return LandLord
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
     * Set street
     *
     * @param string $street
     *
     * @return LandLord
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return LandLord
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return LandLord
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return LandLord
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get companyTelephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set websiteUrl
     *
     * @param string $websiteUrl
     *
     * @return LandLord
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * Get websiteUrl
     *
     * @return string
     */
    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return LandLord
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return LandLord
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

  
  


    /**
     * Set user
     *
     * @param \AuthBundle\Entity\User $user
     *
     * @return LandLord
     */
    public function setUser(\AuthBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AuthBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    
   


//    /**
//     * Add application
//     *
//     * @param \Octopouce\CareerBundle\Entity\Company\Application $application
//     *
//     * @return Profile
//     */
//    public function addApplication(\Octopouce\CareerBundle\Entity\Company\Application $application)
//    {
//        $this->applications[] = $application;
//
//        return $this;
//    }
//
//    /**
//     * Remove application
//     *
//     * @param \Octopouce\CareerBundle\Entity\Company\Application $application
//     */
//    public function removeApplication(\Octopouce\CareerBundle\Entity\Company\Application $application)
//    {
//        $this->applications->removeElement($application);
//    }
//
//    /**
//     * Get applications
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getApplications()
//    {
//        return $this->applications;
//    }

    public function __toString() {
        return $this->name;
    }

    /**
     * Add house
     *
     * @param \ScoutBundle\Entity\House $house
     *
     * @return LandLord
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
     * Constructor
     */
    public function __construct()
    {
        $this->houses = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
