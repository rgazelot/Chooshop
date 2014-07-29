<?php

namespace Chooshop\ChooshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method("GET")
     * @Template("ChooshopBundle:Front:index.html.twig")
     */
    public function indexAction()
    {
        return [];
    }
}
