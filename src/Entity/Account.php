<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="Account")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account implements UserInterface, \Serializable
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
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank()
     */
    private $userName;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;

    /**
     * @var bool
     * 
     * @ORM\Column(name="is_tutor", type="boolean")
     */
    private $isTutor;

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
    public function getUsername()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUsername(string $userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $password
     */
    public function setPlainPassword(string $password)
    {
        $this->plainPassword = $password;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return bool
     */
    public function isTutor()
    {
        return $this->isTutor;
    }

    /**
     * @param bool $tutor
     */
    public function setTutor(bool $tutor)
    {
        $this->isTutor = $tutor;
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

    /**
     * @return array
     */
    public function getRoles()
    {
        if ($this->isTutor) {
            return ['ROLE_ADMIN'];
        }

        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->userName,
            $this->password,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->userName,
            $this->password,
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}
