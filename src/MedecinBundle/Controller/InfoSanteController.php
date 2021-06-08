<?php


namespace MedecinBundle\Controller;


use MedecinBundle\Entity\InfoSante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InfoSanteController extends Controller
{
    public function AjoutInfoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sante = new InfoSante();
        $form = $this->createForm('MedecinBundle\Form\InfoSanteType', $sante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sante);
            $em->flush();
            return $this->redirectToRoute('AfficherMedecin');
        }
        return $this->render('MedecinBundle:InfoSante:AjouterSante.html.twig', array(
            'form' => $form->createView(),


        ));
    }

    public function AfficheAction()
    {
        $m = $this->getDoctrine()->getManager();
        $Info = $m->getRepository("MedecinBundle:InfoSante")->findAll();
        return $this->render('MedecinBundle:InfoSante:test.twig', array(
                'info' => $Info)
        );

    }

    public function detailsMedecinAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $medecin = $em->getRepository('MedecinBundle:Medecin')->find(array("cin" => $id));
        $medecinInfo = $em->getRepository('MedecinBundle:InfoSante')->findBy(array("idmedecin" => $id));

        $sante = new InfoSante();
        $sante->setIdmedecin($medecin);
        $form = $this->createForm('MedecinBundle\Form\InfoSanteType', $sante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sante);
            $em->flush();
            return $this->redirectToRoute('AfficherMedecin');
        }

        return $this->render('MedecinBundle:InfoSante:detailsMedecin.html.twig', array(
            'form' => $form->createView(),
            'm' => $medecin,
            'info'=> $medecinInfo,
        ));
    }

    public function deleteInfoAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $info = $em->getRepository("MedecinBundle:InfoSante")->find( $id);
        // $idc= $info->getIdmedecin();
        $em->remove($info);
        $em->flush();
        return $this->redirectToRoute('AfficherMedecin');
        // return $this->redirectToRoute('InfoMedecin', ['id'=> $idc]);
    }

    public function ModifierInfoSanteAction(Request $request,$id,$idc)
    {
        $em = $this->getDoctrine()->getManager();

        $medecin = $em->getRepository('MedecinBundle:InfoSante')->find($id);
        $editForm = $this->createForm('MedecinBundle\Form\InfoSanteType', $medecin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($medecin);
            $em->flush();

            return $this->redirectToRoute('InfoMedecin',['id'=>$idc]);
        }

        return $this->render('MedecinBundle:InfoSante:ModifierInfoSante.html.twig', array(
            'produit' => $medecin,
            'form' => $editForm->createView(),
        ));
    }
}