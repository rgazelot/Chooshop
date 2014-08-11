<?php

namespace Chooshop\ChooshopBundle\Service;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\NoResultException;

use Chooshop\ChooshopBundle\DTO\ProductTransfer,
    Chooshop\ChooshopBundle\Exception\ProductNotFoundException,
    Chooshop\ChooshopBundle\Entity\User,
    Chooshop\ChooshopBundle\Entity\House,
    Chooshop\ChooshopBundle\Entity\Product as ProductEntity;

class Product
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function all(House $house)
    {
        return $this->em->getRepository('ChooshopBundle:Product')->all($house);
    }

    public function get($id, House $house)
    {
        try {
            return $this->em->getRepository('ChooshopBundle:Product')->get($id, $house);
        } catch (NoResultException $e) {
            throw new ProductNotFoundException(sprintf('Product with the id %d not found', $id), $e);
        }
    }

    public function create(ProductTransfer $productTransfer, User $owner)
    {
        $product = new ProductEntity(
            $productTransfer->getName(),
            $owner,
            $productTransfer->getPriority(),
            $productTransfer->getDescription()
        );

        $this->em->persist($product);
        $this->em->flush();

        return $product;
    }

    public function edit(ProductEntity $product, ProductTransfer $productTransfer)
    {
        $product->setName($productTransfer->getName())
            ->setPriority($productTransfer->getPriority())
            ->setDescription($productTransfer->getDescription());

        $this->em->persist($product);
        $this->em->flush();
    }

    public function delete(ProductEntity $product)
    {
        $this->em->remove($product);
        $this->em->flush();
    }
}
