<?php

namespace MyAppMailBundle\Controller;

use MyAppMailBundle\Entity\Mail;
use MyAppMailBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MailControlerController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppMailBundle:Default:index.html.twig');
    }
    public function sendMailAction(Request $request) {
        $mail = new Mail();
        $form= $this->createForm(MailType::class, $mail);
      //  $request = $this->get(‘request’);
        $form->handleRequest($request) ;
        $mail->setPrenom(" ");

        if ($form->isValid()) {
            $message =\Swift_Message::newInstance()
                ->setSubject($mail->getNom())
                ->setFrom($mail-> getMail())
                ->setTo($mail-> getMail())
                ->setBody($mail->getTxt());
            $em = $this->getDoctrine()->getManager();
            $em->persist($mail);
            $em->flush();
            $this->get('mailer')->send($message);
            return $this->render('MyAppMailBundle:Default:mail.html.twig', array('to' => $mail-> getMail(), 'mail' => $mail-> getMail()
            ));
        }
        return $this->redirect($this->generateUrl('my_app_mail_form'));}
    public function newAction(Request $request) {
        $mail = new Mail();
        $form= $this-> createForm(MailType::class, $mail);
       // $request = $this->get(‘request’);
        $form->handleRequest($request) ;

        if ($form->isValid()) {
            $this->sendMailAction('youssefguerm@gmail.com', $mail-> getMail(), $mail->getNom(), $mail->getTxt());
 }
        return $this->render('MyAppMailBundle:Default:new.html.twig', array('form' => $form->createView())) ; }

}
