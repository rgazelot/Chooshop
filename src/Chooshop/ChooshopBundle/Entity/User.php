<?php

namespace Chooshop\ChooshopBundle\Entity;

use Datetime;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity,
    Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Chooshop\ChooshopBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="User")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=150)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $signupAt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="string")
     */
    private $token;

    public function __construct($email, $firstname, $lastname, $role = null)
    {
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        $this->signupAt = new Datetime;
        $this->token = sha1(uniqid(true) . time());

        $this->roles = ['ROLE_USER'];

        if (null !== $role && 'ROLE_USER' !== $role) {
            $this->roles = array_merge($this->roles, [$role]);
        }
    }

    /**
     * {@inheriteDoc}
     */
    public function getPassword()
    {
    }

    /**
     * {@inheriteDoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheriteDoc}
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * {@inheriteDoc}
     */
    public function eraseCredentials()
    {
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setSignupAt(Datetime $signupAt)
    {
        $this->signupAt = $signupAt;

        return $this;
    }

    public function getSignupAt()
    {
        return $this->signupAt;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}
