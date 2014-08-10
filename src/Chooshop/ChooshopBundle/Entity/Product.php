<?php

namespace Chooshop\ChooshopBundle\Entity;

use Datetime;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\ExclusionPolicy,
    JMS\Serializer\Annotation\Expose,
    JMS\Serializer\Annotation\MaxDepth,
    JMS\Serializer\Annotation\Groups,
    JMS\Serializer\Annotation\Type;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Chooshop\ChooshopBundle\Entity\Repository\ProductRepository")
 * @ORM\Table(name="Product")
 *
 * @ExclusionPolicy("all")
 */
class Product
{
    const PRIORITY_NONE     = 0;
    const PRIORITY_LOW      = 1;
    const PRIORITY_HIGHT    = 2;
    const PRIORITY_CRITICAL = 3;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     * @Groups({"product_details", "product_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Expose
     * @Groups({"product_details", "product_list"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     *
     * @Expose
     * @Type("integer")
     * @Groups({"product_details", "product_list"})
     */
    private $priority;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Expose
     * @Groups({"product_details"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Expose
     * @Groups({"product_details"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Expose
     * @Groups({"product_details", "product_list"})
     */
    private $bought;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Expose
     * @Groups({"product_details"})
     */
    private $boughtAt;

    /**
     * @ORM\ManyToOne(targetEntity="Chooshop\ChooshopBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @Expose
     * @MaxDepth(1)
     * @Groups({"product_details"})
     */
    private $owner;

    public function __construct($name, User $owner, $priority = self::PRIORITY_NONE, $description = null)
    {
        $this->name = $name;
        $this->owner = $owner;

        $this->priority = $priority;
        $this->description = $description;
        $this->createdAt = new Datetime;
        $this->bought = false;
        $this->boughtAt = null;
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

    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setCreatedAt(Datetime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setBought($bought)
    {
        $this->bought = $bought;
    }

    public function getBought()
    {
        return $this->bought;
    }

    public function bought()
    {
        $this->bought = true;
        $this->boughtAt = new Datetime;

        return $this;
    }

    public function isBought()
    {
        return true === $this->bought;
    }

    public function setBoughtAt(Datetime $boughtAt)
    {
        $this->boughtAt = $boughtAt;

        return $this;
    }

    public function getBoughtAt()
    {
        return $this->boughtAt;
    }
}
