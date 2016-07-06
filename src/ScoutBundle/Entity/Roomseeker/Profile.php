<?php

namespace ScoutBundle\Entity\RoomSeeker;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * RoomSeeker
 *
 * @ORM\Table(name="roomseeker_profile")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\RoomSeeker\ProfileRepository")
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_birth", type="datetime")
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="about_you", type="text")
     */
    private $aboutYou;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_path", type="string", length=255, nullable=true, options={"default" = "images2.png"})
     */
    private $picturePath;


    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;

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
     * @ORM\OneToOne(targetEntity="AuthBundle\Entity\User", inversedBy="roomseeker")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */

    private $user;


//    /**
//     * @ORM\OneToMany(targetEntity="\Octopouce\CareerBundle\Entity\Company\Application", mappedBy="jobseeker")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $applications;
//    /**
//     * @ORM\OneToMany(targetEntity="Education", mappedBy="jobseeker")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $educations;
//    /**
//     * @ORM\OneToMany(targetEntity="Experience", mappedBy="jobseeker")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $experiences;




    public function __construct()
    {
//        $this->applications = new ArrayCollection();
//        $this->educations = new ArrayCollection();
//        $this->experiences = new ArrayCollection();
    }

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="resume_path", type="string", length=255)
//     */
//    private $resumePath;

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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Profile
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Profile
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return Profile
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return Profile
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set aboutYou
     *
     * @param string $aboutYou
     *
     * @return Profile
     */
    public function setAboutYou($aboutYou)
    {
        $this->aboutYou = $aboutYou;

        return $this;
    }

    /**
     * Get aboutYou
     *
     * @return string
     */
    public function getAboutYou()
    {
        return $this->aboutYou;
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
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
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
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
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
     * @return \Octopouce\CareerBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
     * Add education
     *
     * @param \Octopouce\CareerBundle\Entity\Jobseeker\Education $education
     *
     * @return Profile
     */
    public function addEducation(\Octopouce\CareerBundle\Entity\Jobseeker\Education $education)
    {
        $this->educations[] = $education;

        return $this;
    }

    /**
     * Remove education
     *
     * @param \Octopouce\CareerBundle\Entity\Jobseeker\Education $education
     */
    public function removeEducation(\Octopouce\CareerBundle\Entity\Jobseeker\Education $education)
    {
        $this->educations->removeElement($education);
    }

    /**
     * Get educations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEducations()
    {
        return $this->educations;
    }

    /**
     * Add experience
     *
     * @param \Octopouce\CareerBundle\Entity\Jobseeker\Experience $experience
     *
     * @return Profile
     */
    public function addExperience(\Octopouce\CareerBundle\Entity\Jobseeker\Experience $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \Octopouce\CareerBundle\Entity\Jobseeker\Experience $experience
     */
    public function removeExperience(\Octopouce\CareerBundle\Entity\Jobseeker\Experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
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
        return $this->firstname;
    }
}
