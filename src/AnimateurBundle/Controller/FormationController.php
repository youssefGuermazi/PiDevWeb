<?php


namespace AnimateurBundle\Controller;


use AnimateurBundle\Entity\Animateur;
use AnimateurBundle\Entity\Animateur_formation;
use AnimateurBundle\Entity\formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormationController extends Controller
{
    public function AddFormationAction( \Symfony\Component\HttpFoundation\Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $formation = new formation();
        $form = $this->createForm('AnimateurBundle\Form\formationType', $formation);
        $form->handleRequest($request);
        $now=new \DateTime('now');
        if ($form->isSubmitted() && $now>=$formation->getDated() && $formation->getDated()<=$formation->getDatef()){
            $em->persist($formation);
            $em->flush();




            return $this->redirectToRoute('Animateur_Affiche');
        }

        return $this->render('AnimateurBundle:Formation:AjoutFormation.html.twig', array(
            'formation' => $formation,
            'form' => $form->createView(),

        ));
    }


    public function ListFormationAction()
    {


        $m = $this->getDoctrine()->getManager();
        $formation = $m->getRepository("AnimateurBundle:formation")->findAll();


        return $this->render('AnimateurBundle:Formation:AfficheFormation.html.twig', array(
            'formation' => $formation
        ));
    }


    public function SupprimeAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $formation = $em->getRepository("AnimateurBundle:formation")->find($id);
        $em->remove($formation);
        $em->flush();
<<<<<<< Updated upstream
       /* $basic  = new \Nexmo\Client\Credentials\Basic('e866b7a7', 'bmB687U1dSopmBt0');
=======
        /*$basic  = new \Nexmo\Client\Credentials\Basic('e866b7a7', 'bmB687U1dSopmBt0');
>>>>>>> Stashed changes
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '21627650325',
            'from' => 'Nexmo',
            'text' => 'formation supprime'
        ]);*/

        return $this->redirectToRoute('Formaton_Affiche');
    }
    public function editformateurAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $formation = $em->getRepository('AnimateurBundle:formation')->find($id);
        $editForm = $this->createForm('AnimateurBundle\Form\formationType', $formation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('Formaton_Affiche');
        }
        $em = $this->getDoctrine()->getManager();

        return $this->render('AnimateurBundle:Formation:editformation.html.twig', array(
            'animateur' => $formation,
            'form' => $editForm->createView(),
        ));
    }

}