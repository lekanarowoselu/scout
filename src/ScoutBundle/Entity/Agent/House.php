<?php

namespace ScoutBundle\Entity\Agent;

use Doctrine\ORM\Mapping as ORM;
use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Job
 *
 * @ORM\Table(name="agent_house")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\Agent\HouseRepository")
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
     * @ORM\Column(name="description", type="text")
     * @Algolia\Attribute
     */
    private $description;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="how_to_apply", type="text")
//     */
//    private $howToApply;

//    /**
//     * @var \DateTime
//     *
//     * @ORM\Column(name="expires_at", type="datetime")
//     */
//    private $expiresAt;

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
     * @ORM\ManyToOne(targetEntity="Profile", inversedBy="houses")
     * @ORM\JoinColumn(name="agent_id", referencedColumnName="id", nullable=false)
     */
    private $agent;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="rooms")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $rooms;

    /**
     * @ORM\ManyToMany(targetEntity="HouseCategory", inversedBy="houses")
     * @ORM\JoinTable(name="agent_houses_categories")
     */
    private $categories;


    /**
     * @ORM\ManyToMany(targetEntity="HouseAmenity", inversedBy="amenities")
     * @ORM\JoinTable(name="agent_houses_amenities")
     */
    private $amenities;



    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->categories = new ArrayCollection();
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

//    /**
//     * Set howToApply
//     *
//     * @param string $howToApply
//     *
//     * @return house
//     */
//    public function setHowToApply($howToApply)
//    {
//        $this->howToApply = $howToApply;
//
//        return $this;
//    }

    /**
     * Get howToApply
     *
     * @return string
     */
//    public function getHowToApply()
//    {
//        return $this->howToApply;
//    }

    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     *
     * @return Job
     */
//    public function setExpiresAt($expiresAt)
//    {
//        $this->expiresAt = $expiresAt;
//
//        return $this;
//    }

//    /**
//     * Get expiresAt
//     *
//     * @return \DateTime
//     */
//    public function getExpiresAt()
//    {
//        return $this->expiresAt;
//    }



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
     * Set company
     *
     * @param \ScoutBundle\Entity\Agent\Profile $agent
     *
     * @return house
     */
    public function setAgent(\ScoutBundle\Entity\Agent\Profile $agent = null)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get company
     *
     * @return \ScoutBundle\Entity\Agent\Profile
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Add application
     *
     * @param \ScoutBundle\Room $room
     *
     * @return House
     */
    public function addRoom(\Octopouce\CareerBundle\Entity\Agent\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove application
     *
     * @param \Octopouce\CareerBundle\Entity\Company\Application $application
     */
    public function removeApplication(\Octopouce\CareerBundle\Entity\Company\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Add category
     *
     * @param \Octopouce\CareerBundle\Entity\Company\JobCategory $category
     *
     * @return Job
     */
    public function addCategory(\Octopouce\CareerBundle\Entity\Company\JobCategory $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Octopouce\CareerBundle\Entity\Company\JobCategory $category
     */
    public function removeCategory(\Octopouce\CareerBundle\Entity\Company\JobCategory $category)
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

        public function __toString()
    {
        return $this->getCompany()->getName();
    }
}
