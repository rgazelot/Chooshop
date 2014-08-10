<?php

namespace Chooshop\ChooshopBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function all()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.priority', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function get($id)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}
