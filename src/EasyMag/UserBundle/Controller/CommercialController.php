<?php

namespace EasyMag\UserBundle\Controller;

use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommercialController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commercial = $em->getRepository(Commercial::class)->findOneByUser($this->getUser());

        return $this->render('EasyMagUserBundle:BackOffice/Commercial:index.html.twig', array(
            'commercial' => $commercial,
        ));
    }

    public function mainMenuAction()
    {

        return $this->render('EasyMagUserBundle:BackOffice/Commercial:main_menu.html.twig', array(
           //....
        ));
    }

    public function topMenuAction()
    {

        return $this->render('EasyMagUserBundle:BackOffice/Commercial:top_menu.html.twig', array(
            //....
        ));
    }

    public function profileAction()
    {

        $em = $this->getDoctrine()->getManager();
        $commercial = $em->getRepository(Commercial::class)->findOneByUser($this->getUser());


        return $this->render('EasyMagUserBundle:BackOffice/Commercial:profile.html.twig', array(
            'commercial' => $commercial,
        ));
    }

}