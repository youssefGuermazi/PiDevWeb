<?php

namespace AnimateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Club/Default/layoutFront.html.twig');
    }
}
