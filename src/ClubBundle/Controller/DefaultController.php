<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\club;
use ClubBundle\Entity\evenement;
use ClubBundle\Entity\participe;
use ClubBundle\Form\clubType;
use ClubBundle\Form\evenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Club/Default/layoutFront.html.twig');
    }

    public function AjoutClubAction(Request $request)
    {
        $club = new club();
        $form = $this->createForm(clubType::class, $club);
        $form->handleRequest($request);
        $now = new \DateTime('now');
        if ($form->isSubmitted() && $now >= $club->getDateCreation()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('affichclub');
        }
        return $this->render('@Club/Default/ajoutClub.html.twig', array('form' => $form->createView()));
    }

    public function afficheClubAction()
    {
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository("ClubBundle:club")->findAll();
        return $this->render("@Club/Default/afficheClub.html.twig", array('club' => $club));
    }

    public function supprimerClubAction($nom)
    {
        $club = $this->getDoctrine()->getRepository("ClubBundle:club")->find($nom);
        $em = $this->getDoctrine()->getManager();
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute('affichclub');

    }

    function UpdateClubAction(Request $request, $nom)
    {
        $club = $this->getDoctrine()->getRepository(Club::class)->find($nom);
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted()) {
            $em->flush();
            return $this->redirectToRoute('affichclub');
        }
        return $this->render('@Club/Default/ajoutClub.html.twig', array('form' => $form->createView()));
    }

    public function AjoutEvenementAction(Request $request)
    {
        $evenement = new evenement();
        $form = $this->createForm(evenementType::class, $evenement);
        $form->handleRequest($request);
        $evenement->getClub();
        $now = new \DateTime('now');
        if ($form->isSubmitted() && $form->isValid() && $evenement->getDateFin() >= $evenement->getDateDebut() && $now <= $evenement->getDateFin() && $now <= $evenement->getDateDebut()) {
            $em = $this->getDoctrine()->getManager();
            $evenement->setNomfile("3.jpg");
            $evenement->getUploadFile();
            $evenement->setNbp(20);
            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute('affichevent');
        }
        return $this->render('@Club/Default/ajoutevenement.html.twig', array('form' => $form->createView()));
    }

    public function afficheEvenementAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("ClubBundle:evenement")->findAll();
        $listevenement = $this->get('knp_paginator')->paginate($evenement, $request->query->get('page', 1), 3);
        return $this->render("@Club/Default/afficheevenement.html.twig", array('evenement' => $listevenement));
    }

    public function supprimerEvenementAction($id)
    {
        $evenement = $this->getDoctrine()->getRepository("ClubBundle:evenement")->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute('affichevent');

    }

    function UpdateEvenementAction(Request $request, $id)
    {
        $evenement = $this->getDoctrine()->getRepository(evenement::class)->find($id);
        $form = $this->createForm(evenementType::class, $evenement);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted()) {
            $em->flush();
            return $this->redirectToRoute('ajoutevenement');
        }
        return $this->render('@Club/Default/ajoutevenement.html.twig', array('form' => $form->createView()));
    }

    public function afficheEvenementfrontAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("ClubBundle:evenement")->findAll();
        $listevenement = $this->get('knp_paginator')->paginate($evenement, $request->query->get('page', 1), 3);
        return $this->render("@Club/Default/afficheventfront.html.twig", array('evenement' => $listevenement));
    }

    public function afficheClubfrontAction()
    {
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository("ClubBundle:club")->findAll();
        return $this->render("@Club/Default/afficheClubfront.html.twig", array('club' => $club));
    }

    function rechercheClubfrontAction(Request $request)
    {
        $club = new club();

        $Form = $this->createFormBuilder($club)
            ->add('nom')
            ->add('Recherche', SubmitType::class, ['attr' => ['nom' => 'nom']])
            ->getForm();
        $Form->handleRequest($request);
        if ($Form->isSubmitted()) {
            $club = $this->getDoctrine()->getRepository(club::class)->findBy(array('nom' => $club->getNom()));
        }
        return $this->render("@Club/Default/rechercheClubfront.html.twig", array('f' => $Form->createView(), 'c' => $club));
    }

    function rechercheeventfrontAction(Request $request)
    {
        $evenement = new evenement();

        $Form = $this->createFormBuilder($evenement)
            ->add('nom')
            ->add('Recherche', SubmitType::class, ['attr' => ['nom' => 'nom']])
            ->getForm();
        $Form->handleRequest($request);
        if ($Form->isSubmitted()) {
            $evenement = $this->getDoctrine()->getRepository(evenement ::class)->findBy(array('nom' => $evenement->getNom()));
        }
        return $this->render("@Club/Default/rechercheeventfront.html.twig", array('f' => $Form->createView(), 'c' => $evenement));
    }

    function participerAction(Request $request, $id , $etat)
    {
        $evenet = $this->getDoctrine()->getRepository(evenement::class)->find($id);
        if($etat == 'accepter')
        {
            $evenet->setNbp($evenet->getNbp() - 1);
            $listParticipant = $evenet->getParticipants();
            $listParticipant->add($this->getUser());
            $evenet->setParticipants($listParticipant);
        }else{
            $evenet->setNbp($evenet->getNbp() + 1);
            $listParticipant = $evenet->getParticipants();
            $listParticipant->removeElement($this->getUser());
            $evenet->setParticipants($listParticipant);

        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($evenet);
        $em->flush();
        return $this->redirectToRoute('afficheventfront');
    }
}