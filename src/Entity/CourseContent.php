<?php

namespace App\Entity;

use App\Entity\Course;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CourseContent")
 * @ORM\Entity(repositoryClass="App\Repository\CourseContentRepository")
 */
class CourseContent
{
    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $content;

    /**
     * @var Course
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="content", cascade={"persist"})
     */
    private $course;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return Course
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
