<?php

namespace Chooshop\ChooshopBundle\Entity;

use Datetime;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\ExclusionPolicy,
    JMS\Serializer\Annotation\Expose,
    JMS\Serializer\Annotation\Groups,
    JMS\Serializer\Annotation\Type;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Chooshop\ChooshopBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="User")
 *
 * @ExclusionPolicy("all")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     * @Groups({"product_details"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=150)
     *
     * @Expose
     * @Groups({"product_details"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Expose
     * @Groups({"product_details"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Expose
     * @Groups({"product_details"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Expose
     */
    private $signupAt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="string")
     *
     * @Expose
     */
    private $token;

    /**
     * @ORM\OneToMany(targetEntity="Chooshop\ChooshopBundle\Entity\Product", mappedBy="owner")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity="Chooshop\ChooshopBundle\Entity\House", inversedBy="people")
     * @ORM\JoinColumn(name="house_id", referencedColumnName="id")
     */
    private $house;

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

        $this->products = new ArrayCollection;
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

    public function getProducts()
    {
        return $this->products;
    }

    public function setHouse(House $house)
    {
        $this->house = $house;

        return $this;
    }

    public function getHouse()
    {
        return $this->house;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
