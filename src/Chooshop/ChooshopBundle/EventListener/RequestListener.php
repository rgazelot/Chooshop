<?php

namespace Chooshop\ChooshopBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent,
    Symfony\Component\HttpKernel\HttpKernelInterface;

use Chooshop\ChooshopBundle\Exception\ApiTokenNotFoundException,
    Chooshop\ChooshopBundle\Service\Api\Login;

/**
 * Listener that is responsible to catch all api request to retrieve token from Headers or query
 * and log the user with it.
 */
class RequestListener
{
    private $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST || !preg_match('/^api/', $request->attributes->get('_route'))) {
            return;
        }

        $token = $request->headers->get('Token', $request->query->get('token'));

        if (null === $token) {
            throw new ApiTokenNotFoundException;
        }

        $this->login->authenticate($token);
    }
}
