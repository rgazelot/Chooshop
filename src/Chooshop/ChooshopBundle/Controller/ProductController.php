<?php

namespace Chooshop\ChooshopBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController,
    FOS\RestBundle\Controller\Annotations\RouteResource;

use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("Product")
 */
class ProductController extends FOSRestController
{
    public function postAction(Request $request)
    {

    }
}
