<?php
/**
 * Created by PhpStorm.
 * User: dev2
 * Date: 06/06/16
 * Time: 15:51
 */

namespace ScoutBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * SurfaceArea
 *
 * @ORM\Table(name="villa_surface_area")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\VillaSurfaceAreaRepository")
 */

class VillaSurfaceArea
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

//    /**
//     * @ORM\ManyToOne(targetEntity="Villa", inversedBy="surface_areas")
//     * @ORM\JoinColumn(name="villa_id", referencedColumnName="id", nullable=false)
//     */
//    private $villa;

    /**
     * @ORM\ManyToMany(targetEntity="VillaSurfaceArea")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="villaSurfaceArea_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="villaSurfaceArea_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="villaSurfaceAreas")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;
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
     * Set name
     *
     * @param string $name
     *
     * @return VillaSurfaceArea
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
     * @return VillaSurfaceArea
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
     * Set villa
     *
     * @param \ScoutBundle\Entity\Villa $villa
     *
     * @return VillaSurfaceArea
     */
    public function setVilla(\ScoutBundle\Entity\Villa $villa)
    {
        $this->villa = $villa;

        return $this;
    }

    /**
     * Get villa
     *
     * @return \ScoutBundle\Entity\Villa
     */
    public function getVilla()
    {
        return $this->villa;
    }

    public function __toString()
    {
       return $this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add translation
     *
     * @param \ScoutBundle\Entity\VillaSurfaceArea $translation
     *
     * @return VillaSurfaceArea
     */
    public function addTranslation(\ScoutBundle\Entity\VillaSurfaceArea $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \ScoutBundle\Entity\VillaSurfaceArea $translation
     */
    public function removeTranslation(\ScoutBundle\Entity\VillaSurfaceArea $translation)
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
     * @return VillaSurfaceArea
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
}
