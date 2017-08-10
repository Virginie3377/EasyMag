<?php

namespace EasyMag\OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EasyMagOrderBundle:Default:index.html.twig');
    }
}
