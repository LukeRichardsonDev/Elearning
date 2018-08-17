<?php

namespace App\Entity;

use App\Entity\Question;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="Choice")
 * @ORM\Entity(repositoryClass="App\Repository\ChoiceRepository")
 */
class Choice
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
     * @var Question
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="choices")
     */
    private $question;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $choice;

    /**
     * @var bool
     * 
     * @ORM\Column(name="is_answer", type="boolean")
     */
    private $isAnswer;

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
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getChoice()
    {
        return $this->choice;
    }

    /**
     * @param string $choice
     */
    public function setChoice(string $choice)
    {
        $this->choice = $choice;
    }

    /**
     * @return bool
     */
    public function isAnswer()
    {
        return $this->isAnswer;
    }

    /**
     * @param bool $answer
     */
    public function setAnswer(bool $answer)
    {
        $this->isAnswer = $answer;
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
