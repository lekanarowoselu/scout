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
 * locations
 *
 * @ORM\Table(name="house_location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HouseLocationRepository")
 */

class HouseLocation
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
//     * @ORM\ManyToOne(targetEntity="House", inversedBy="locations")
//     * @ORM\JoinColumn(name="house_id", referencedColumnName="id", nullable=false)
//     */
//    private $villa;

    /**
     * @ORM\ManyToMany(targetEntity="HouseLocation")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="houseLocation_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="houseLocation_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;


    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="HouseLocations")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;


    /****************************************************/


}
