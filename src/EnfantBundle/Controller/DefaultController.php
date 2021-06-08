<?php

namespace EnfantBundle\Controller;

use EnfantBundle\Entity\enfant;
use EnfantBundle\Entity\suivi;
use EnfantBundle\Form\enfantType;
use EnfantBundle\Form\suiviType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EnfantBundle:Front:index.html.twig');
    }
    public function chartAction()
    {
        return $this->render('@Enfant/Default/chart.html.twig');
    }
    public function AjoutAction(Request $request)
    {
        $enfant= new enfant();
        $form=$this->createForm(enfantType::class,$enfant);
        $form->handleRequest($request);
        $user = $this->getUser()->getId();
        $enfant->setParent($user);
        $now=new \DateTime("now");
        if($form->isSubmitted()&&$now>$enfant->getDn())
        {
            $num=$this->getDoctrine()->getRepository(enfant::class)->findNumber($enfant->getGarderie());

            if(count($num)<100){
                $enfant->setNomfile("3.jpg");
                $enfant->getUploadFile();
                $em=$this->getDoctrine()->getManager();
                $em->persist($enfant);
                $em->flush();
                return $this->redirect('Afficher/'.$user);
            }
            else{
                echo "<script>alert(\"le nombre des enfants ne doit pas depasser 100\")
</script>";
            }
        }
        return $this->render('@Enfant/Default/ajoutEnfant.html.twig',array('form'=>$form->createView()));
    }
    public function AjoutSuiviAction(Request $request)
    {
        $suivi= new suivi();
        $form=$this->createForm(suiviType::class,$suivi);
        $form->handleRequest($request);
        $now=new \DateTime("now");
        if($form->isSubmitted()&&$now>=$suivi->getDate())
        {
            if(($suivi->getNoteAnglais()+$suivi->getNoteFrancais()+$suivi->getNoteInfo())/3>=10 and ($suivi->getNoteAnglais()+$suivi->getNoteFrancais()+$suivi->getNoteInfo())/3<15)
            $suivi->setEvaluation('moyenne');
            if(($suivi->getNoteAnglais()+$suivi->getNoteFrancais()+$suivi->getNoteInfo())/3<10)
            $suivi->setEvaluation('faible');
            if(($suivi->getNoteAnglais()+$suivi->getNoteFrancais()+$suivi->getNoteInfo())/3>=15)
            $suivi->setEvaluation('excellent');

            $em=$this->getDoctrine()->getManager();
            $em->persist($suivi);
            $em->flush();
            return $this->redirect('affichesuivi');
        }
        return $this->render('@Enfant/Default/ajoutSuivi.html.twig',array('form'=>$form->createView()));
    }
    function ModifierAction(Request $request,$id){
        $enfant=$this->getDoctrine()->getRepository(enfant::class)->find($id);
        $form=$this->createForm(enfantType::class,$enfant);
        $form->handleRequest($request);
        $user = $this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        if($form->isSubmitted())
        {
            $enfant->setNomfile("3.jpg");
            $enfant->getUploadFile();
            $em->flush();
            return $this->redirect($this->generateUrl('afficher',array('id' => $user)));
        }
        return $this->render('@Enfant/Default/ModifierClub.html.twig',array('form'=>$form->createView()));
    }
    public function AfficherAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $enfant= $em->getRepository('EnfantBundle:enfant')->findByParent($id);
        return $this->render('@Enfant/Default/afficher.html.twig',array('enfants'=>$enfant));
    }
    public function AfficherResponsableAction()
    {
        $em=$this->getDoctrine()->getManager();
        $enfant= $em->getRepository('EnfantBundle:enfant')->findAll();
        return $this->render('@Enfant/Default/afficherenfantresponsable.html.twig',array('enfants'=>$enfant));
    }
    public function AfficherSuiviEnfantAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $suivi= $em->getRepository('EnfantBundle:suivi')->findByEnfant($id);
        return $this->render('@Enfant/Default/afficheSuiviEnfant.html.twig',array('suivi'=>$suivi));
    }

    function SuppressionAction($id){
        $enfant=$this->getDoctrine()->getRepository(enfant::class)->find($id);
        $user = $this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        $em->remove($enfant);
        $em->flush();
        return $this->redirect($this->generateUrl('afficher',array('id' => $user)));
    }
    function SuppressionResAction($id){
        $enfant=$this->getDoctrine()->getRepository(enfant::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($enfant);
        $em->flush();
        return $this->redirectToRoute('AfficherResponsable');
    }
    public function AfficherSuiviResponsableAction()
    {
        $em=$this->getDoctrine()->getManager();
        $suivi= $em->getRepository('EnfantBundle:suivi')->findAll();
        return $this->render('@Enfant/Default/afficheSuiviResponsable.html.twig',array('suivi'=>$suivi));
    }
    function ModifiersuiviAction(Request $request,$id){
        $suivi=$this->getDoctrine()->getRepository(suivi::class)->find($id);
        $form=$this->createForm(suiviType::class,$suivi);
        $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        if($form->isSubmitted())
        {
            $em->flush();
            return $this->redirectToRoute('afficherSuiviResponsable');
        }
        return $this->render('@Enfant/Default/ModifierSuivi.html.twig',array('form'=>$form->createView()));
    }
    function SuppressionSuiviAction($id){
        $suivi=$this->getDoctrine()->getRepository(suivi::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($suivi);
        $em->flush();
        return $this->redirectToRoute('afficherSuiviResponsable');
    }
    function pdfAction($id)
    {   $snappy = $this->get('knp_snappy.pdf');
        $em=$this->getDoctrine()->getManager();
        $suivi= $em->getRepository('EnfantBundle:suivi')->findByEnfant($id);
        $html= $this->render('@Enfant/Default/pdf.html.twig',array('suivi'=>$suivi));
        $filename='myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );

    }
}
