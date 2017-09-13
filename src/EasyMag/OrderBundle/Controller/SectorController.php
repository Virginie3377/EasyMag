<?php

namespace EasyMag\OrderBundle\Controller;

use EasyMag\OrderBundle\Entity\Customer;
use EasyMag\OrderBundle\Entity\Sector;
use EasyMag\OrderBundle\Form\SectorType;
use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sector controller.
 *
 */
class SectorController extends Controller
{
    /**
     * Lists all sector entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sectors = $em->getRepository('EasyMagOrderBundle:Sector')->findAll();
        return $this->render('@EasyMagOrder/sector/index.html.twig', array(
            'sectors' => $sectors,
        ));
    }

    /**
     * Creates a new sector entity.
     *
     */
    public function newAction(Request $request)
    {
        $sector = new Sector();
        $form = $this->createForm(SectorType::class, $sector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sector);
            $em->flush();

            return $this->redirectToRoute('secteur_show', array('id' => $sector->getId()));
        }

        return $this->render('@EasyMagOrder/sector/new.html.twig', array(
            'sector' => $sector,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sector entity.
     *
     */
    public function showAction(Request $request, Sector $sector)
    {
        $deleteForm = $this->createDeleteForm($sector);

        $em = $this->getDoctrine()->getManager();
        $customers = $sector->getCustomers();

        return $this->render('@EasyMagOrder/sector/show.html.twig', array(
            'sector' => $sector,
            'customers' => $customers,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sector entity.
     *
     */
    public function editAction(Request $request, Sector $sector)
    {
        $deleteForm = $this->createDeleteForm($sector);
        $editForm = $this->createForm('EasyMag\OrderBundle\Form\SectorType', $sector);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('secteur_edit', array('id' => $sector->getId()));
        }

        return $this->render('@EasyMagOrder/sector/edit.html.twig', array(
            'sector' => $sector,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Lists all sector entities by year.
     *
     */
    public function indexYearAction(Request $request, $datepublication)
    {
        $em = $this->getDoctrine()->getManager();
        $commercial = $em->getRepository(Commercial::class)->findOneByUser($this->getUser());
        $sectorbyyear = $em->getRepository(Sector::class)->findSectorByCommercialByYear($commercial, $datepublication);

//        var_dump($sectorbyyear);die();
        return $this->render('@EasyMagOrder/sector/indexYear.html.twig', array(
            'sectors' => $sectorbyyear,
        ));
    }

    /**
     * Deletes a sector entity.
     *
     */
    public function deleteAction(Request $request, Sector $sector)
    {
        $form = $this->createDeleteForm($sector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sector);
            $em->flush();
        }

        return $this->redirectToRoute('secteur_index');
    }

    /**
     * Creates a form to delete a sector entity.
     *
     * @param Sector $sector The sector entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sector $sector)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secteur_delete', array('id' => $sector->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
