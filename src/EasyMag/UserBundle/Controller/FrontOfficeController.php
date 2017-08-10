<?php

namespace EasyMag\UserBundle\Controller;

use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontOfficeController extends Controller
{
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
            return $this->render('EasyMagUserBundle:FrontOffice:index.html.twig');
    }
}
