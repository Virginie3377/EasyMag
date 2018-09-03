<?php

namespace EasyMag\UserBundle\Controller;

use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EasyMag\UserBundle\Entity\Souscriber;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use EasyMag\UserBundle\Form\SouscriberType;


class FrontOfficeController extends Controller
{
    /**
     * Lists all customer entities.
     *
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();

            if ($user->getType() == 'COMMERCIAL'){
                $commercial = $em->getRepository(Commercial::class)->findByUser($user);
                $request->getSession()->set('user_account', $commercial);
                return $this->redirectToRoute('commercial_index');
            }


        }
        $souscriber = new Souscriber();
        $form = $this->createForm(SouscriberType::class, $souscriber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($souscriber);
            $em->flush();

        return $this->redirectToRoute('easy_mag_user_homepage');
        }


            return $this->render('EasyMagUserBundle:FrontOffice:index.html.twig', array(
            'souscriber' => $souscriber,
            'form' => $form->createView(),
        ));

    }

    public function contactAction()
    {
        $message = \Swift_Message::newInstance()
                                 ->setSubject('Formulaire de reception')
                                 ->setFrom('send@example.com')
                                 ->setTo('contact@lessentieldevotreville.fr')
                                 ->setBody($this->renderView(
                                     'EasyMagUserBundle::contact_email.html.twig', array(
                                     'nom'    => $_POST['nom'],
                                     'email'   => $_POST['email'],
                                     'tel'     => $_POST['tel'],
                                     'message' => $_POST['message']
                                 )), 'text/html'
                                 );

        $this->get('mailer')->send($message);
        $this->addFlash('info', 'Votre message a bien été envoyée.');

        return $this->redirectToRoute('easy_mag_user_homepage');
    }

    
   

    public function magEnLigneAction()
    {
        return $this->render('EasyMagUserBundle:FrontOffice:mag_en_ligne.html.twig', array(
            //....
        ));
    }
}
