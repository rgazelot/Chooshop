<?php

namespace Chooshop\ChooshopBundle\Exception;

use Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    public function __construct($email, Exception $previous = null, $code = 0)
    {
        parent::__construct(sprintf('User not found with the email %s', $email), $previous, $code);
    }
}
