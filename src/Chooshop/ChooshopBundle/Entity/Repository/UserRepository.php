<?php

namespace Chooshop\ChooshopBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findByToken($token)
    {
        return $this->createQueryBuilder('u')
            ->addSelect('h')
                ->leftJoin('u.house', 'h')
            ->where('u.token = :token')
                ->setParameter('token', $token)
            ->getQuery()
            ->getSingleResult();
    }

    public function findByemail($email)
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
                ->setParameter('email', $email)
            ->getQuery()
            ->getSingleResult();
    }
}
