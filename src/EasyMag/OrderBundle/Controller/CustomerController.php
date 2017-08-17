<?php

namespace EasyMag\OrderBundle\Controller;

use EasyMag\OrderBundle\Entity\Customer;
use EasyMag\OrderBundle\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Customer controller.
 *
 */
class CustomerController extends Controller
{
    /**
     * Lists all customer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('EasyMagOrderBundle:Customer')->findAll();

        return $this->render('@EasyMagOrder/customer/index.html.twig', array(
            'customers' => $customers,
        ));
    }

    /**
     * Creates a new customer entity.
     *
     */
    public function newAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('client_show', array('id' => $customer->getId()));
        }

        return $this->render('@EasyMagOrder/customer/new.html.twig', array(
            'customer' => $customer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a customer entity.
     *
     */
    public function showAction(Customer $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);

        return $this->render('@EasyMagOrder/customer/show.html.twig', array(
            'customer' => $customer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing customer entity.
     *
     */
    public function editAction(Request $request, Customer $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);
        $editForm = $this->createForm('EasyMag\OrderBundle\Form\CustomerType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_edit', array('id' => $customer->getId()));
        }

        return $this->render('@EasyMagOrder/customer/edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a customer entity.
     *
     */
    public function deleteAction(Request $request, Customer $customer)
    {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a customer entity.
     *
     * @param Customer $customer The customer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customer $customer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $customer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
