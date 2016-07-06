<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Page
 *
 * @ORM\Table(name="page", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="page_title_idx", columns={"title", "lang_id"}),
 *     @ORM\UniqueConstraint(name="page_slug_idx", columns={"slug", "lang_id"}),
 *     @ORM\UniqueConstraint(name="page_name_idx", columns={"page_name", "lang_id"}),
 *     @ORM\UniqueConstraint(name="page_meta_title_idx", columns={"meta_title", "lang_id"})
 *     })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 *
 * @UniqueEntity(
 *     fields={"title", "lang"},
 *     errorPath="title",
 *     message="This Title has already been added on this language."
 * )
 *  * @UniqueEntity(
 *     fields={"slug", "lang"},
 *     errorPath="slug",
 *     message="This slug has already been added on this language."
 * )
 *  * @UniqueEntity(
 *     fields={"pageName", "lang"},
 *     errorPath="pageName",
 *     message="This pageName has already been added on this language."
 * )
 *  * @UniqueEntity(
 *     fields={"metaTitle", "lang"},
 *     errorPath="metaTitle",
 *     message="This metaTitle has already been added on this language."
 * )

 * @ORM\HasLifecycleCallbacks()
 * 
 */


class Page
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255)
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
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=128)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="page_name", type="string", length=255)
     */
    private $pageName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="special", type="boolean")
     */
    private $special;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_in_menu", type="boolean")
     */
    private $showInMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var int
     *
     * @ORM\Column(name="sorting", type="integer", nullable=true)
     */
    private $sorting;

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
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="pages")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;


    /**
     * @ORM\ManyToMany(targetEntity="Page")
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="page_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="page_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * @var pageCategory
     *
     * @ORM\ManyToOne(targetEntity="PageCategory", inversedBy="pages")
     * @ORM\JoinColumn(name="page_category_id", referencedColumnName="id")
     */
    private $pageCategory;

//    /**
//     * @ORM\OneToMany(targetEntity="Image", mappedBy="page")
//     * @var \Doctrine\Common\Collections\ArrayCollection
//     */
//    private $images;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Slider")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id")
     */

  
    private $slider;



//
//    /**
//     * NOTE: This is not a mapped field of entity metadata, just a simple property.
//     *
//     * @Vich\UploadableField(mapping="page_banner", fileNameProperty="bannername")
//     *
//     * @var File
//     */
//    private $imageFile;
//
//    /**
//     * @var string
//     *
//     * @ORM\Column(name="banenrname", type="string", length=255, )
//     */
//    private $bannername;


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
     * Set title
     *
     * @param string $title
     *
     * @return Page
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
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return Page
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Page
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {

        preg_match_all("/\<img.+src\=(?:\"|\')(.+?)(?:\"|\')(?:.+?)\>/",$this->content,$match);
        foreach ($match[1] as $key => $path) {
            //check if internal link
            $tab = explode("/",$path,2);
            if($tab[0] !== "..")
                continue;
            preg_match("#/uploads/(.)+\.[png|jpg|jpeg|gif]+#",$path,$url);//Catch real path from web
            //Rebuild url
            $path = $url[0];
            //on the tag, search old path and replace by rebuild path
            $newtag = str_replace($match[1][$key],$path,$match[0][$key]);
            //add css class
            $newtag = str_replace(">","class='img-responsive' >",$newtag);
            $newtag = preg_replace('/([width|height]+="\d+")/',"",$newtag);

            //replace content with new img tag
            $this->content = str_replace($match[0][$key],$newtag,$this->content);}
        return $this->content;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return page
     */
    public function setSlug($slug)
    {
       $this->slug = $slug;
        

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Page
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set pageName
     *
     * @param string $pageName
     *
     * @return Page
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;

        return $this;
    }

    /**
     * Get pageName
     *
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * Set special
     *
     * @param string $special
     *
     * @return Page
     */
    public function setSpecial($special)
    {
        $this->special = $special;

        return $this;
    }

    /**
     * Get special
     *
     * @return string
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * Set showInMenu
     *
     * @param integer $showInMenu
     *
     * @return Page
     */
    public function setShowInMenu($showInMenu)
    {
        $this->showInMenu = $showInMenu;

        return $this;
    }

    /**
     * Get showInMenu
     *
     * @return int
     */
    public function getShowInMenu()
    {
        return $this->showInMenu;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Page
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return Page
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * Get sorting
     *
     * @return int
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * Set createdAt
     *
     * @internal param \DateTime $createdAt
     * @return Page
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
     * @return Page
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
     * Set lang
     *
     * @param \AppBundle\Entity\Lang $lang
     *
     * @return Page
     */
    public function setLang(\AppBundle\Entity\Lang $lang = null)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return \AppBundle\Entity\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set pageCategory
     *
     * @param \AppBundle\Entity\PageCategory $pageCategory
     *
     * @return Page
     */
    public function setPageCategory(\AppBundle\Entity\PageCategory $pageCategory = null)
    {
        $this->pageCategory = $pageCategory;

        return $this;
    }

    /**
     * Get pageCategory
     *
     * @return \AppBundle\Entity\PageCategory
     */
    public function getPageCategory()
    {
        return $this->pageCategory;
    }
    /**
     * Constructor
     */


    //   /**
//     * Add translation
//     *
//     * @param \AppBundle\Entity\Page $translation
//     *
//     * @return Page
//     */
//    public function addTranslation(\AppBundle\Entity\Page $translation)
//    {
//        $this->translations[] = $translation;
//
//        return $this;
//    }
//
//    /**
//     * Remove translation
//     *
//     * @param \AppBundle\Entity\Page $translation
//     */
//    public function removeTranslation(\AppBundle\Entity\Page $translation)
//    {
//        $this->translations->removeElement($translation);
//    }
//
//
//    /**
//     * Get translations
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getTranslations()
//    {
//        return $this->translations;
//    }

    /**
     * @return array
     */
    public function getTranslations()
    {
        return $this->translations->toArray();
    }

    /**
     * @param  Page $page
     * @return void
     */
    public function addTranslation(Page $page)
    {
        if (!$this->translations->contains($page)) {
            $this->translations->add($page);
            $page->addTranslation($this);
        }
    }

    /**
     * @param  Page $page
     * @return void
     */
    public function removeTranslation(Page $page)
    {
        if ($this->translations->contains($page)) {
            $this->translations->removeElement($page);
            $page->removeTranslation($this);
        }
    }



//    /**
//     * Set bannername
//     *
//     * @param string $bannername
//     *
//     * @return Page
//     */
//    public function setBannername($bannername)
//    {
//        $this->bannername = $bannername;
//
//        return $this;
//    }
//
//    /**
//     * Get bannername
//     *
//     * @return string
//     */
//    public function getBannername()
//    {
//        return $this->bannername;
//    }
//
//
//    /**
//     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
//     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
//     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
//     * must be able to accept an instance of 'File' as the bundle will inject one here
//     * during Doctrine hydration.
//     *
//     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
//     *
//     * @return VillaImage
//     */
//    public function setImageFile(File $image = null)
//    {
//        $this->imageFile = $image;
//
//        if ($image) {
//            // It is required that at least one field changes if you are using doctrine
//            // otherwise the event listeners won't be called and the file is lost
//            $this->updatedAt = new \DateTime('now');
//        }
//
//        return $this;
//    }
//
//    /**
//     * @return File
//     */
//    public function getImageFile()
//    {
//        return $this->imageFile;
//    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function __toString()

        //return $this->getTitle();

    {
        return $this->getLang()->getName()." - ".$this->getTitle();
    }


    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Page
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
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
     * Set slider
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return Page
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


}
