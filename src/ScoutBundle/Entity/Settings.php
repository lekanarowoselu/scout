<?php
/**
 * Created by PhpStorm.
 * User: dev2
 * Date: 08/06/16
 * Time: 17:35
 */
namespace ScoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\SettingsRepository")
 */
class Settings
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
     * @ORM\Column(name="siteName", type="string", length=255)
     */
    private $siteName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=100)
     */
    private $telephone;


    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="settings")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;


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
     * Set siteName
     *
     * @param string $siteName
     *
     * @return Settings
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Settings
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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Settings
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Settings
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
     * Set lang
     *
     * @param \ScoutBundle\Entity\Lang $lang
     *
     * @return Settings
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
