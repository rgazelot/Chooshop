<?php

namespace Chooshop\ChooshopBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

use Chooshop\ChooshopBundle\Entity\House;

class ProductRepository extends EntityRepository
{
    public function all(House $house)
    {
        return $this->createQueryBuilder('p')
            ->addSelect('o')
                ->leftJoin('p.owner', 'o')
            ->where('o.house = :house')
                ->setParameter('house', $house)
            ->orderBy('p.priority', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function get($id, House $house)
    {
        return $this->createQueryBuilder('p')
            ->addSelect('o')
                ->leftJoin('p.owner', 'o')
            ->where('p.id = :id')
                ->setParameter('id', $id)
            ->andWhere('o.house = :house')
                ->setParameter('house', $house)
            ->getQuery()
            ->getSingleResult();
    }
}
