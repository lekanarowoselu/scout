<?php
/**
 * Created by PhpStorm.
 * User: dev2
 * Date: 06/06/16
 * Time: 15:52
 */

namespace AppBundle\Entity;



use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * images
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 * @UniqueEntity("name")
 * @UniqueEntity("imageFilename")
 * @UniqueEntity("imageFilename")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Image
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;




    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="image", fileNameProperty="imageFilename")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="imageFilename", type="string", length=255, unique=true)
     */
    private $imageFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

 

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
//     * @ORM\ManyToMany(targetEntity="Slider", mappedBy="images")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $sliders;

//    /**
//     * @var Slider
//     *
//     * @ORM\ManyToOne(targetEntity="Slider", inversedBy="images")
//     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id")
//     */
//    private $slider;
//    /**
//     * @var Slider
//     *
//     * @ORM\ManyToOne(targetEntity="Slider")
//     */
//    private $slider;

//    /**
//     * @var Page
//     *
//     * @ORM\ManyToOne(targetEntity="Villa", inversedBy="images")
//     * @ORM\JoinColumn(name="villa_id", referencedColumnName="id")
//     */
//    private $villa;

//    /**
//     * @ORM\ManyToOne(targetEntity="Villa", inversedBy="images")
//     * @ORM\JoinColumn(name="villa_id", referencedColumnName="id", nullable=false)
//     */
//    private $villa;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Page", inversedBy="images")
//     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=false)
//     */
//    private $page;



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
     * @return Image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            //$this->updatedAt = new \DateTime('now');
            $this->setUpdatedAt();
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
     * @return Image
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
     * @return Image
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
     * @return Image
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
     * @return Image
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
     * @param \AppBundle\Entity\Villa $villa
     *
     * @return Image
     */
    public function setVilla(\AppBundle\Entity\Villa $villa)
    {
        $this->villa = $villa;

        return $this;
    }

    /**
     * Get villa
     *
     * @return \AppBundle\Entity\Villa
     */
    public function getVilla()
    {
        return $this->villa;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Image
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
     * Set page
     *
     * @param \AppBundle\Entity\Page $page
     *
     * @return Image
     */
    public function setPage(\AppBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \AppBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set slider
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return Image
     */
    public function setSlider(\AppBundle\Entity\Slider $slider = null)
    {
        $this->slider = $slider;

        return $this;
    }

    /**
     * Get slider
     *
     * @return \AppBundle\Entity\Slider
     */
    public function getSlider()
    {
        return $this->slider;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sliders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add slider
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return Image
     */
    public function addSlider(\AppBundle\Entity\Slider $slider)
    {
        $this->sliders[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param \AppBundle\Entity\Slider $slider
     */
    public function removeSlider(\AppBundle\Entity\Slider $slider)
    {
        $this->sliders->removeElement($slider);
    }

    /**
     * Get sliders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSliders()
    {
        return $this->sliders;
    }

    /**
     * Set imageFilename
     *
     * @param string $imageFilename
     *
     * @return Image
     */
    public function setImageFilename($imageFilename)
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    /**
     * Get imageFilename
     *
     * @return string
     */
    public function getImageFilename()
    {
        return $this->imageFilename;
    }

    public function __toString()
    {
        return $this->name ;
    }
}
