<?php

namespace App\Entity;

use App\Entity\Course;
use App\Entity\MaterialType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CourseMaterials")
 * @ORM\Entity(repositoryClass="App\Repository\CourseMaterialsRepository")
 */
class CourseMaterials
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Course
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="materials")
     */
    private $course;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=150)
     */
    private $location;

    /**
     * @var MaterialType
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\MaterialType")
     */
    private $materialType;

    /**
     * @var bool
     * 
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param Course $course
     */
    public function setCourse(Course $course)
    {
        $this->course = $course;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    /**
     * @return MaterialType
     */
    public function getType()
    {
        return $this->materialType;
    }

    /**
     * @param MaterialType $type
     */
    public function setType(MaterialType $type)
    {
        $this->materialType = $type;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->isActive = $active;
    }
}
