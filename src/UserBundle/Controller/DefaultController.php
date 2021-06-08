<?php

namespace UserBundle\Controller;

use ClubBundle\Entity\club;
use ClubBundle\Form\clubType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
    {

        return $this->render('@Club/Default/layoutFront.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);



    }
    public function ParentAction()
    {
        return $this->render('@Club/Default/layoutFront.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    public function ResponsableAction(Request $request)
    {
        return $this->render('@Club/Default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    public function AdminAction()
    {
        return $this->render('@Club/Default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
