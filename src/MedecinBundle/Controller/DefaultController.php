<?php

namespace MedecinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MedecinBundle:Default:index.html.twig');
    }
}
