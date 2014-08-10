<?php

namespace Chooshop\ChooshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity(repositoryClass="Chooshop\ChooshopBundle\Entity\Repository\HouseRepository")
 * @ORM\Table(name="House")
 *
 * @ExclusionPolicy("all")
 */
class House
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Chooshop\ChooshopBundle\Entity\User", mappedBy="house", cascade={"persist"})
     */
    private $people;

    public function __construct($name)
    {
        $this->name = $name;

        $this->people = new ArrayCollection;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addPeople(User $user)
    {
        $user->setHouse($this);
        $this->people->add($user);

        return $this;
    }

    public function getPeople()
    {
        return $this->people;
    }
}
