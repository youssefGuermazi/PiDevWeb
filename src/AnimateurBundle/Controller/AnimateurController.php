<?php


namespace AnimateurBundle\Controller;


use AnimateurBundle\Entity\Animateur;
use AnimateurBundle\Entity\Animateur_formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AnimateurController extends Controller
{

    public function AddAnimateurAction( \Symfony\Component\HttpFoundation\Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $animateur = new Animateur();
        $form = $this->createForm('AnimateurBundle\Form\AnimateurType', $animateur);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $animateur->setNomfile("3.jpg");
            $animateur->getUploadFile();
            $em->persist($animateur);
            $em->flush();




            return $this->redirectToRoute('Animateur_Affiche');
        }

        return $this->render('AnimateurBundle:Animateur:AjoutAnimateur.html.twig', array(
            'animateur' => $animateur,
            'form' => $form->createView(),

        ));
    }

    public function ListAnimateurAction()
    {


        $m = $this->getDoctrine()->getManager();
        $animateur = $m->getRepository("AnimateurBundle:Animateur")->findAll();


        return $this->render('AnimateurBundle:Animateur:AfficheAnimateur.html.twig', array(
            'animateur' => $animateur
        ));
    }
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $animateur = $em->getRepository("AnimateurBundle:Animateur")->find($id);
        $em->remove($animateur);
        $em->flush();
        return $this->redirectToRoute('Animateur_Affiche');
    }
    public function detailsAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $animateur = $em->getRepository('AnimateurBundle:Animateur')->find(array("cin" => $id));

        $formationannimateur = new Animateur_formation();
        $formationannimateur->setIdAnimateur($animateur);
        $form = $this->createForm('AnimateurBundle\Form\Animateur_formationType', $formationannimateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $numf=$this->getDoctrine()->getRepository(Animateur::class)->findFormation($formationannimateur->getIdformateur());
            if(count($numf)<2){
                $em->persist($formationannimateur);
                $em->flush();
                return $this->redirectToRoute('Animateur_Affiche');
            }
            else{
                echo"<script>alert(\"le nombre des formations ne doit pas depasser 2\")</script>";
            }

        }

        //var_dump($id);exit();
        return $this->render('AnimateurBundle:Animateur:detailsAnimateur.html.twig', array(
            'animateur' => $animateur,
            'form' => $form->createView(),
            'formanima' => $formationannimateur,

<<<<<<< Updated upstream
        ));
    }
=======
        ));}



>>>>>>> Stashed changes
    public function editAnimateurAction(Request $request, $cin)
    {
        $em = $this->getDoctrine()->getManager();

        $animateur = $em->getRepository('AnimateurBundle:Animateur')->find($cin);
        $editForm = $this->createForm('AnimateurBundle\Form\AnimateurType', $animateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($animateur);
            $em->flush();

            return $this->redirectToRoute('Animateur_Affiche');
        }
        $em = $this->getDoctrine()->getManager();

        return $this->render('AnimateurBundle:Animateur:editAnimateur.html.twig', array(
            'animateur' => $animateur,
            'form' => $editForm->createView(),
        ));
    }

    public function ListAnimateurFrontAction()
    {


        $m = $this->getDoctrine()->getManager();
        $animateur = $m->getRepository("AnimateurBundle:Animateur")->findAll();


        return $this->render('AnimateurBundle:Animateur:AfficheFrontAnimateur.html.twig', array(
            'animateur' => $animateur
        ));
    }

    public function detailsFrontAnimateurAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $animateur = $em->getRepository('AnimateurBundle:Animateur')->find(array("cin" => $id));
        $formation = $em->getRepository('AnimateurBundle:Animateur_formation')->findBy(array("idAnimateur" => $id));



        //var_dump($id);exit();
        return $this->render('AnimateurBundle:Animateur:detailsFrontAnimateur.html.twig', array(
            'a' => $animateur,
            'formation' => $formation,

        ));
    }


    public function rateAction(\Symfony\Component\HttpFoundation\Request $request){
        $data = $request->getContent();
        $obj = json_decode($data,true);

        $em = $this->getDoctrine()->getManager();
        $rate =$obj['rate'];
        $idc = $obj['animateur'];
        $animateur = $em->getRepository("AnimateurBundle:Animateur")->find($idc);
        $note = ($animateur->getRate()*$animateur->getVote() + $rate)/($animateur->getVote()+1);
        $animateur->setVote($animateur->getVote()+1);
        $animateur->setRate($note);
        $em->persist($animateur);
        $em->flush();
        return new Response($animateur->getRate());
    }

}
