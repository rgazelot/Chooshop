<?php

namespace Chooshop\ChooshopBundle\Service;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\NoResultException;

use Chooshop\ChooshopBundle\DTO\UserTransfer,
    Chooshop\ChooshopBundle\Exception\EmailUnavailableException,
    Chooshop\ChooshopBundle\Exception\UserNotFoundException,
    Chooshop\ChooshopBundle\Entity\User as UserEntity,
    Chooshop\ChooshopBundle\Entity\House;

class User
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function get($email)
    {
        try {
            return $this->em->getRepository('ChooshopBundle:User')->findByEmail($email);
        } catch (NoResultException $e) {
            throw new UserNotFoundException($email, $e);
        }
    }

    /**
     * @throw EmailUnavailableException
     */
    public function create(House $house, UserTransfer $userTransfer)
    {
        try {
            $this->get($userTransfer->getEmail());

            throw new EmailUnavailableException($userTransfer->getEmail());
        } catch (UserNotFoundException $e) {}

        $user = new UserEntity(
            $userTransfer->getEmail(),
            $userTransfer->getFirstname(),
            $userTransfer->getLastname(),
            $userTransfer->getRole()
        );

        $house->addPeople($user);

        $this->em->persist($house);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
