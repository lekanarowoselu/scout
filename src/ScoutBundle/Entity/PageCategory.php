<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * PageCategory
 *
 * @ORM\Table(name="page_category", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="page_category_title_idx", columns={"title", "lang_id"}),
 *     @ORM\UniqueConstraint(name="page_category_slug_idx", columns={"slug", "lang_id"}),
 *     @ORM\UniqueConstraint(name="page_category_meta_title_idx", columns={"meta_title", "lang_id"})
 *     })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageCategoryRepository")
 *
 * @UniqueEntity("title")
 * @UniqueEntity("slug")
 *
 * @UniqueEntity("metaTitle")
 *
 * @ORM\HasLifecycleCallbacks()
 */
class PageCategory
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
     *
     * ORM\@OneToMany(targetEntity="PageCategory", mappedBy="parent")
     **/
    private $children;
    /**
     * @ORM\ManyToOne(targetEntity="PageCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

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
     * @var int
     *
     * @ORM\Column(name="sorting", type="integer", nullable=true)
     */
    private $sorting;
    /**
     * @var boolean
     *
     * @ORM\Column(name="show_in_menu", type="boolean")
     */
    private $showInMenu;
    /**
     * @var boolean
     *
     * @ORM\Column(name="special", type="boolean")
     */
    private $special;

    /**
     * @ORM\ManyToMany(targetEntity="PageCategory",cascade={"remove", "persist"})
     * ORM\JoinTable(name="translations",
     *     joinColumns={@JoinColumn(name="pageCategory_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="pageCategory_b_id", referencedColumnName="id")}
     * )
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="pageCategories")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Page", mappedBy="pageCategory")
     */
    private $pages;

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
     * @return PageCategory
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
     * Set slug
     *
     * @param string $slug
     *
     * @return PageCategory
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
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return PageCategory
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
     * @return PageCategory
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
     * Set createdAt
     *
     * @internal param \DateTime $createdAt
     * @return PageCategory
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
     * @return PageCategory
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
     * Set sorting
     *
     * @param integer $sorting
     *
     * @return PageCategory
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
     * Constructor
     */


    /**
     * Set lang
     *
     * @param \AppBundle\Entity\Lang $lang
     *
     * @return PageCategory
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
     * Add page
     *
     * @param \AppBundle\Entity\Page $page
     *
     * @return PageCategory
     */
    public function addPage(\AppBundle\Entity\Page $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \AppBundle\Entity\Page $page
     */
    public function removePage(\AppBundle\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add translation
     *
     * @param \AppBundle\Entity\PageCategory $translation
     *
     * @return PageCategory
     */
    public function addTranslation(\AppBundle\Entity\PageCategory $translation)
    {
        $this->translations[] = $translation;

        return $this;


//        if (!$this->translations->contains($page)) {
//            $this->translations->add($page);
//            $page->addTranslation($this);
//        }
    }

    /**
     * Remove translation
     *
     * @param \AppBundle\Entity\PageCategory $translation
     */
    public function removeTranslation(\AppBundle\Entity\PageCategory $translation)
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
        return $this->translations->toArray();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function __toString()

        //return $this->getTitle();

    {
        return $this->getLang()->getName()." - ".$this->getTitle();
    }


    /**
     * Set showInMenu
     *
     * @param boolean $showInMenu
     *
     * @return PageCategory
     */
    public function setShowInMenu($showInMenu)
    {
        $this->showInMenu = $showInMenu;

        return $this;
    }

    /**
     * Get showInMenu
     *
     * @return boolean
     */
    public function getShowInMenu()
    {
        return $this->showInMenu;
    }

    /**
     * Set special
     *
     * @param boolean $special
     *
     * @return PageCategory
     */
    public function setSpecial($special)
    {
        $this->special = $special;

        return $this;
    }

    /**
     * Get special
     *
     * @return boolean
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\PageCategory  $parent
     *
     * @return PageCategory
     */
    public function setParent(\AppBundle\Entity\PageCategory  $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return PageCategory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

}
