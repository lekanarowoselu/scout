<?php

// src/AuthBundle/Entity/User.php
namespace AuthBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", options={"default":1}, nullable=true)
     *
     * @Assert\NotBlank(message="What are you interested in?.", groups={"Registration", "Profile"})
     *
     * @Assert\Choice(choices = {"2", "3"}, message = "Choose a valid interest.")
     */
    public $usertype;

    /**
     * @ORM\OneToOne(targetEntity="ScoutBundle\Entity\RoomSeeker", mappedBy="user")
     */
    public $roomseeker;

    /**
     * @ORM\OneToOne(targetEntity="ScoutBundle\Entity\LandLord" , mappedBy="user")
     */
    public $landlord;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Get usertype
     *
     * @return int
     */
    public function getUserType()
    {
        return $this->usertype;
    }

    public function getRoomSeeker()
    {
        return $this->roomseeker;
    }

    public function getLandLord()
    {
        return $this->landlord;
    }

    public function setRoomseeker(\ScoutBundle\Entity\RoomSeeker $roomseeker)
    {
        $this->roomseeker = $roomseeker;

        return $this;
    }


    public function setAgent(\ScoutBundle\Entity\LandLord $landlord)
    {
        $this->landlord = $landlord;

        return $this;
    }

///*// @Assert\Length(
////          min=3,
//          max=255,
//          minMessage="The name is too short.",
//          maxMessage="The name is too long.",
//          groups={"Registration", "Profile"}
//      )*/

}