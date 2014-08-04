<?php

namespace Chooshop\ChooshopBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserTransfer
{
    /**
     * @Assert\Email()
     */
    protected $email;

    /**
     * @Assert\Type(type="string")
     * @Assert\Length(max="100")
     */
    protected $firstname;

    /**
     * @Assert\Type(type="string")
     * @Assert\Length(max="100")
     */
    protected $lastname;

    /**
     * @Assert\Choice(choices={"ROLE_USER", "ROLE_ROOT"}, message="Choose a valid role")
     */
    protected $role;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }
}
