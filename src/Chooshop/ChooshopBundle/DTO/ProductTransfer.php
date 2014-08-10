<?php

namespace Chooshop\ChooshopBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

use Chooshop\ChooshopBundle\Entity\Product;

class ProductTransfer
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max="100")
     */
    private $name;

    /**
     * @Assert\NotNull()
     * @Assert\Type(type="integer")
     * @Assert\Choice(choices={0, 1, 2, 3})
     */
    private $priority;

    /**
     * @Assert\Type(type="string")
     * @Assert\Length(max="500")
     */
    private $description;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
