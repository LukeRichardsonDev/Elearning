<?php

namespace App\Entity;

use App\Entity\Account;
use App\Entity\CourseContent;
use App\Entity\CourseMaterials;
use App\Entity\Question;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="Course")
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
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
    private $courseName;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=150)
     */
    private $description;

    /**
     * @var Account
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", cascade={"persist"})
     */
    private $createdBy;

    /**
     * @var ArrayCollection|CourseContent[]
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\CourseContent", mappedBy="course", cascade={"persist"})
     */
    private $content;

    /**
     * @var ArrayCollection|CourseMaterials[]
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\CourseMaterials", mappedBy="course")
     */
    private $materials;

    /**
     * @var ArrayCollection|Question[]
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="course")
     */
    private $questions;

    /**
     * @var bool
     * 
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->content = new ArrayCollection();
        $this->materials = new ArrayCollection();
        $this->questions = new ArrayCollection();
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
    public function getCourseName()
    {
        return $this->courseName;
    }

    /**
     * @param string $courseName
     */
    public function setCourseName(string $courseName)
    {
        $this->courseName = $courseName;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return Account
     */
    public function createdBy()
    {
        return $this->createdBy;
    }

    /**
     * @param Account $createdBy
     */
    public function setCreatedBy(Account $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return CourseContent[]
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param CourseContent $content
     */
    public function addContent(CourseContent $content)
    {
        if (!$this->content->contains($content)) {
            $content->setCourse($this);
            $this->content->add($content);
        }
    }

    /**
     * @param CourseContent $content
     */
    public function removeContent(CourseContent $content)
    {
        foreach ($this->content as $key => $currentContent) {
            if ($content === $currentContent) {
                $this->content->remove($key);
            }
        }
    }

    /**
     * @return CourseMaterials[]
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * @param CourseMaterials $material
     */
    public function addMaterial(CourseMaterials $material)
    {
        if (!$this->materials->contains($material)) {
            $material->setCourse($this);
            $this->materials->add($material);
        }
    }

    /**
     * @param CourseMaterials $material
     */
    public function removeMaterial(CourseMaterials $material)
    {
        foreach ($this->materials as $key => $currentMaterials) {
            if ($material === $currentMaterials) {
                $this->materials->remove($key);
            }
        }
    }

    /**
     * @return Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param Question $question
     */
    public function addQuestion(Question $question)
    {
        if (!$this->questions->contains($question)) {
            $question->setCourse($this);
            $this->questions->add($question);
        }
    }

    /**
     * @param Question $question
     */
    public function removeQuestion(Question $question)
    {
        foreach ($this->questions as $key => $currentQuestions) {
            if ($question === $currentQuestions) {
                $this->questions->remove($key);
            }
        }
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
