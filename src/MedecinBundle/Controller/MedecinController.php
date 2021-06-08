<?php


namespace MedecinBundle\Controller;


use MedecinBundle\Entity\InfoSante;
use MedecinBundle\Entity\Medecin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MedecinController extends Controller
{

    public function AjoutMedecinAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $medecin = new Medecin();
        $form = $this->createForm('MedecinBundle\Form\MedecinType', $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medecin->setNomfile("3.jpg");
            $medecin->getUploadFile();
            $em->persist($medecin);
            $em->flush();
            return $this->redirectToRoute('AfficherMedecin');
        }
        return $this->render('MedecinBundle:Medecin:AjouterMedecin.html.twig', array(
            'form' => $form->createView(),


        ));
    }

    public function AfficheAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $Medecin = $m->getRepository("MedecinBundle:Medecin")->findAll();

        /**
         * @var $paginator |Knp|Component|Pager|Paginator
         */
        $paginator = $this->get ('knp_paginator');
        $result = $paginator-> paginate (
            $Medecin,
            $request->query->getInt ('page', 1),
            $request-> query-> getInt ('limit', 2)
        );



        return $this->render('MedecinBundle:Medecin:AfficherMedecin.html.twig', array(
                'medecin' => $result)
        );

    }

    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $medecin = $em->getRepository("MedecinBundle:Medecin")->find($id);
        $em->remove($medecin);
        $em->flush();

        return $this->redirectToRoute('AfficherMedecin');
    }

    public function ModifierMedcinAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $medecin = $em->getRepository('MedecinBundle:Medecin')->find($id);
        $editForm = $this->createForm('MedecinBundle\Form\MedecinType', $medecin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($medecin);
            $em->flush();

            return $this->redirectToRoute('AfficherMedecin');
        }

        return $this->render('MedecinBundle:Medecin:ModifierMedecin.html.twig', array(
            'produit' => $medecin,
            'form' => $editForm->createView(),
        ));
    }

    public function AfficheMedecinFrontAction()
    {
        $m = $this->getDoctrine()->getManager();
        $Medecin = $m->getRepository("MedecinBundle:Medecin")->findAll();
        return $this->render('MedecinBundle:Medecin:AfficherMedecinFront.html.twig', array(
                'medecin' => $Medecin)
        );
    }

    public function detailsMedecinFrontAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $medecin = $em->getRepository('MedecinBundle:Medecin')->find(array("cin" => $id));
        $medecinInfo = $em->getRepository('MedecinBundle:InfoSante')->findBy(array("idmedecin" => $id));



        return $this->render('MedecinBundle:InfoSante:detailsFrontMedecin.html.twig', array(
            'm' => $medecin,
            'info'=> $medecinInfo,
        ));
    }



    function rechercheAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $medecin=$em->getRepository("MedecinBundle:Medecin")->findAll();
        if($request->isMethod("POST"))
        {
            $nom= $request->get('nom');
            $medecin=$em->getRepository("MedecinBundle:Medecin")->findBy(array('nom'=>$nom));

        }
        return $this->render('@Medecin/Medecin/Recherche.html.twig',
            array('m'=>$medecin));

    }




}