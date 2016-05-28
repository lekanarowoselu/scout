<?php

namespace ScoutBundle\Entity\Agent;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="agent_house_room_feature")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\Agent\HouseCategoryRepository")
 */
class RoomFeature
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
     * @ORM\ManyToMany(targetEntity="Room", mappedBy="categories")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $rooms;

    public function __construct() {
        $this->rooms = new ArrayCollection();
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
     * @return RoomCategory
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
     * @return RoomCategory
     *
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
     * Add room
     *
     * @param \ScoutBundle\Entity\Agent\Room $room
     *
     * @return RoomCategory
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
    public function removeRoom(\ScoutBundle\Entity\Agent\Room $room )
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get room
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }
    /*    public function __toString()
        {
            return $this->getName();
        }*/
    public function getCategory()
    {
        return $this->getName();
    }
}
