<?php
/**
 * Created by PhpStorm.
 * User: dev2
 * Date: 06/06/16
 * Time: 15:52
 */

namespace ScoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * Slider
 *
 * @ORM\Table(name="slider")
 * @ORM\Entity(repositoryClass="ScoutBundle\Repository\SliderRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Slider
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
//     * @var int
//     *
//     * @ORM\Column(name="sorting", type="integer", nullable=true)
//     */
//    private $sorting;


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
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

//    /**
//     * @ORM\ManyToMany(targetEntity="Slider")
//     * ORM\JoinTable(name="translations",
//     *     joinColumns={@JoinColumn(name="slider_a_id", referencedColumnName="id")},
//     *     inverseJoinColumns={@JoinColumn(name="slider_b_id", referencedColumnName="id")}
//     * )
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    protected $translations;

//    /**
//     * @var Lang
//     *
//     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="sliders")
//     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
//     */
//    private $lang;

//    /**
//     * @ORM\OneToOne(targetEntity="ScoutBundle\Entity\Page", inversedBy="slider")
//     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
//     */
//
//    private $page;
//
//    /**
//     * @ORM\OneToOne(targetEntity="ScoutBundle\Entity\Villa", inversedBy="slider")
//     * @ORM\JoinColumn(name="villa_id", referencedColumnName="id")
//     */
//
//    private $villa;

//    /**
//     * @ORM\OneToMany(targetEntity="Image", mappedBy="slider")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $images;

  
//    /**
//     * @ORM\ManyToOne(targetEntity="Image")
//     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
//     */

    /**
     * @ORM\ManyToMany(targetEntity="Image")
     * @ORM\JoinTable(name="slider_image",
     *      joinColumns={@ORM\JoinColumn(name="slider_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

//    /**
//     * @ORM\OneToOne(targetEntity="ScoutBundle\Entity\Page" , mappedBy="slider")
//     */
//    public $page;
//
//    /**
//     * @ORM\OneToOne(targetEntity="ScoutBundle\Entity\Villa" , mappedBy="slider")
//     */
//    public $villa;
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Slider
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }


    /**
     * Set createdAt
     *
     * @internal param \DateTime $createdAt
     * @return Slider
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

    }   /**
 * Set updatedAt
 *
 * @ORM\PrePersist
 * @internal param \DateTime $updatedAt
 * @return Slider
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
     * Set name
     *
     * @param string $name
     *
     * @return Slider
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
     * @return VillaImage
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
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return Slider
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * Get sorting
     *
     * @return integer
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Slider
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    /**
     * Constructor
     */


    /**
     * Add translation
     *
     * @param \ScoutBundle\Entity\Slider $translation
     *
     * @return Slider
     */
    public function addTranslation(\ScoutBundle\Entity\Slider $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \ScoutBundle\Entity\Slider $translation
     */
    public function removeTranslation(\ScoutBundle\Entity\Slider $translation)
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
     * @return Slider
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add image
     *
     * @param \ScoutBundle\Entity\Image $image
     *
     * @return Slider
     */
    public function addImage(\ScoutBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }
    public function setImages(ArrayCollection $images)
    {
        $this->images = $images;

        return $this;
    }
    /**
     * Remove image
     *
     * @param \ScoutBundle\Entity\Image $image
     */
    public function removeImage(\ScoutBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set page
     *
     * @param \ScoutBundle\Entity\Page $page
     *
     * @return Slider
     */
    public function setPage(\ScoutBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \ScoutBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set villa
     *
     * @param \ScoutBundle\Entity\Villa $villa
     *
     * @return Slider
     */
    public function setVilla(\ScoutBundle\Entity\Villa $villa = null)
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
//        return $this->getName()."--".$this->getLocale();
        return $this->getName();
    }
}
