<?php

namespace App\Entity;

use App\Entity\Choice;
use App\Entity\Course;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="Question")
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
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
    private $question;

    /**
     * @var Course
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="questions")
     */
    private $course;

    /**
     * @var ArrayCollection|Choice[]
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Choice", mappedBy="question")
     */
    private $choices;

    /**
     * @var bool
     * 
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
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
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question)
    {
        $this->question = $question;
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
     * @return Choice[]
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param Choice $choice
     */
    public function addChoice(Choice $choice)
    {
        $this->content->add($choice);
    }

    /**
     * @param Choice $choice
     */
    public function removeChoice(Choice $choice)
    {
        foreach ($this->choices as $key => $currentChoices) {
            if ($choice === $currentChoices) {
                $this->choices->remove($key);
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
