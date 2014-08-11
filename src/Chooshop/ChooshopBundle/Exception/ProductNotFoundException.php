<?php

namespace Chooshop\ChooshopBundle\Exception;

use Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductNotFoundException extends NotFoundHttpException
{
    public function __construct($message = 'Product not found', Exception $previous = null, $code = 0)
    {
        parent::__construct($message, $previous, $code);
    }
}
