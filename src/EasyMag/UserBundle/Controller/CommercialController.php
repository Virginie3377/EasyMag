<?php

namespace EasyMag\UserBundle\Controller;

use EasyMag\OrderBundle\Entity\Sector;
use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommercialController extends Controller
{
    public function indexAction()
    {
        $today = new \DateTime('today');
        $em = $this->getDoctrine()->getManager();
        $commercial = $em->getRepository(Commercial::class)->findOneByUser($this->getUser());
        $ventesbyDay = $em->getRepository(Commercial::class)->findVentesByDay($today);
        $ventesbyYear = $em->getRepository(Commercial::class)->findVentesByCommercialByYear();
        //$validations = 'todo';$em->getRepository(Commercial::class)->findValidationByMagazine('test');

        return $this->render('EasyMagUserBundle:BackOffice/Commercial:index.html.twig', array(
            'commercial' => $commercial,
            'ventesbyDay' => $ventesbyDay,
            'ventebyYear'=> $ventesbyYear,
            //'validations' => $validations,
        ));
    }

    public function mainMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $commercial = $em->getRepository(Commercial::class)->findOneByUser($this->getUser());
        $sectors = $em->getRepository(Sector::class)->find3LastSectorByCommercial($commercial);
//        $sectorbyyear = $em->getRepository(Sector::class)->findSectorByCommercialByYear($commercial);


        return $this->render('EasyMagUserBundle:BackOffice/Commercial:main_menu.html.twig', array(
           'sectors' => $sectors,
//            'sectorYear' => $sectorbyyear,
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
