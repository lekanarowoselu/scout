<?php

namespace ScoutBundle\Entity\LandLord;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * LandLord
 *
 * @ORM\Table(name="landlord_profile")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\LandLord\ProfileRepository")
 *
 * @ORM\HasLifecycleCallbacks
 *
 */
class Profile
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
     * @ORM\OneToOne(targetEntity="AuthBundle\Entity\User", inversedBy="agent")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */

    private $user;


//    /**
//     * @ORM\OneToMany(targetEntity="Application", mappedBy="company")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $applications;

    /**
     * @ORM\OneToMany(targetEntity="House", mappedBy="agent")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $houses;

    public function __construct()
    {
        $this->houses = new ArrayCollection();
        //$this->applications = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="picture_path", type="string", length=255, nullable=true, options={"default" = "images.png"}))
     */
    private $picturePath;



    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;


    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
//    public function setFile(UploadedFile $file = null)
//    {
//        $this->file = $file;
//    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * Add job
     *
     * @param \ScoutBundle\Entity\Agent\House $house
     *
     * @return Profile
     */
    public function addJob(\ScoutBundle\Entity\Agent\house $house)
    {
        $this->houses[] = $house;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \ScoutBundle\Entity\Agent\House $house
     */
    public function removeJob(\ScoutBundle\Entity\Agent\house $house)
    {
        $this->houses->removeElement($house);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouses()
    {
        return $this->houses;
    }

    /**
     * Set user
     *
     * @param \AuthBundle\Entity\User $user
     *
     * @return Profile
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

    /**
     * Set picturePath
     *
     * @param string $picturePath
     *
     * @return Profile
     */
    public function setPicturePath($picturePath)
    {
        $this->picturePath = $picturePath;

        return $this;
    }

    /**
     * Get picturePath
     *
     * @return string
     */
    public function getPicturePath()
    {
        return $this->picturePath;
    }

    public function getAbsolutePath()
    {
        return null === $this->picturePath
            ? null
            : $this->getUploadRootDir().'/'.$this->picturePath;
    }

    public function getWebPath()
    {
        return null === $this->picturePath
            ? null
            : $this->getUploadDir().'/'.$this->picturePath;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    private $temp;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->picturePath)) {
            // store the old name to delete after the update
            $this->temp = $this->picturePath;
            $this->picturePath = null;
        } else {
            $this->picturePath = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->picturePath = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->picturePath);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
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
}
