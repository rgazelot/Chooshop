<?php

namespace Chooshop\ChooshopBundle\Service\Api;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\NoResultException;

use Symfony\Component\Security\Core\SecurityContextInterface,
    Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Chooshop\ChooshopBundle\Exception\UserNotFoundException;

/**
 * All about the login and authentication via the API
 */
class Login
{
    private $em;
    private $securityContext;

    public function __construct(EntityManager $em, SecurityContextInterface $securityContext)
    {
        $this->em = $em;
        $this->securityContext = $securityContext;
    }

    public function authenticate($token)
    {
        try {
            $user = $this->em->getRepository('ChooshopBundle:User')->findByToken($token);
        } catch (NoResultException $e) {
            throw new NotFoundHttpException('User not found');
        }

        $this->securityContext->setToken(new UsernamePasswordToken($user, null, 'main', $user->getRoles()));
    }
}
