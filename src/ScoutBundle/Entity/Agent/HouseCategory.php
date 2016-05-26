<?php

namespace ScoutBundle\Entity\Agent;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="agent_house_category")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\Agent\HouseCategoryRepository")
 */
class HouseCategory
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
     * @ORM\ManyToMany(targetEntity="House", mappedBy="categories")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $houses;

    public function __construct() {
        $this->houses = new ArrayCollection();
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
     * @return HouseCategory
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
     * @return HouseCategory
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
     * Add house
     *
     * @param \ScoutBundle\Entity\Agent\House $house
     *
     * @return HouseCategory
     */
    public function addHouse(\ScoutBundle\Entity\Agent\House $house)
    {
        $this->houses[] = $house;

        return $this;
    }

    /**
     * Remove house
     *
     * @param \ScoutBundle\Entity\Agent\House $house
     */
    public function removeHouse(\ScoutBundle\Entity\Agent\House $house )
    {
        $this->houses->removeElement($house);
    }

    /**
     * Get house
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouses()
    {
        return $this->houses;
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
