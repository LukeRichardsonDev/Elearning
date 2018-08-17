<?php

namespace App\Entity;

use App\Entity\Account;
use App\Entity\Course;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CourseAttempt")
 * @ORM\Entity(repositoryClass="App\Repository\CourseAttemptRepository")
 */
class CourseAttempt
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
     * @var Course
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Course")
     */
    private $course;

    /**
     * @var Account
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     */
    private $student;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $attempt;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $mark;

    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean")
     */
    private $pass;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Account
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Account $student
     */
    public function setStudent(Account $student)
    {
        $this->student = $student;
    }

    /**
     * @return int
     */
    public function getAttempt()
    {
        return $this->attempt;
    }

    public function addAttempt()
    {
        ++$this->student;
    }

    /**
     * @return int
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * @param int $mark
     */
    public function setMark(int $mark)
    {
        $this->mark = $mark;
    }

    /**
     * @return bool
     */
    public function hasPassed()
    {
        return $this->pass;
    }

    /**
     * @param bool $passed
     */
    public function setPassed(bool $passed)
    {
        $this->pass = $passed;
    }
}
