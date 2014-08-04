<?php

namespace Chooshop\ChooshopBundle\Exception;

use Exception;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class EmailUnavailableException extends ConflictHttpException
{
    public function __construct($email, Exception $previous = null, $code = 0)
    {
        parent::__construct(sprintf('%s already used', $email), $previous, $code);
    }
}
