<?php

namespace Octopouce\CareerBundle\Entity\Company;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="company_job_category")
 * @ORM\Entity(repositoryClass="Octopouce\CareerBundle\Repository\Company\JobCategoryRepository")
 */
class JobCategory
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
     * @ORM\ManyToMany(targetEntity="Job", mappedBy="categories")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $jobs;

    public function __construct() {
        $this->jobs = new ArrayCollection();
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
     * @return JobCategory
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
     * @return JobCategory
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
     * Add job
     *
     * @param \Octopouce\CareerBundle\Entity\Company\Job $job
     *
     * @return JobCategory
     */
    public function addJob(\Octopouce\CareerBundle\Entity\Company\Job $job)
    {
        $this->jobs[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \Octopouce\CareerBundle\Entity\Company\Job $job
     */
    public function removeJob(\Octopouce\CareerBundle\Entity\Company\Job $job)
    {
        $this->jobs->removeElement($job);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobs()
    {
        return $this->jobs;
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
