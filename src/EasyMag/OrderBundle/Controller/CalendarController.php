<?php

namespace EasyMag\OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalendarController extends Controller
{
    public function indexAction()
    {
        return $this->render('EasyMagOrderBundle:Calendar:index.html.twig');
    }
}
