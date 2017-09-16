<?php

namespace EasyMag\OrderBundle\Controller;

use EasyMag\OrderBundle\Datatables\CommandDatatable;
use EasyMag\OrderBundle\Entity\Command;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Command controller.
 *
 */
class CommandController extends Controller
{
    /**
     * Lists all command entities.
     *
     * @param Request $request
     *
     * @Route("/", name="command_index")
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();
        // Get your Datatable ...
        //$datatable = $this->get('app.datatable.post');
        //$datatable->buildDatatable();

        // or use the DatatableFactory
        /** @var DatatableInterface $datatable */
        $datatable = $this->get('sg_datatables.factory')->create(CommandDatatable::class);
        $datatable->buildDatatable();

        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);

            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            $datatableQueryBuilder->buildQuery();
            return $responseService->getResponse();
        }


        return $this->render('@EasyMagOrder/command/index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * Creates a new command entity.
     *
     * @Route("/new", name="command_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $command = new Command();
        $form = $this->createForm('EasyMag\OrderBundle\Form\CommandType', $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command->setDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();

            $em->persist($command);
            $em->flush();

            return $this->redirectToRoute('command_show', array('id' => $command->getId()));
        }

        return $this->render('@EasyMagOrder/command/new.html.twig', array(
            'command' => $command,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Command entity.
     *
     * @param Command $command
     *
     * @Route("/{id}/show", name = "command_show")
     * @Method("GET")
     */
    public function showAction(Command $command)
    {
        $deleteForm = $this->createDeleteForm($command);
        //Récupérer tous les clients
       $em = $this->getDoctrine()->getManager();
       $customers = $em->getRepository('EasyMagOrderBundle:Customer')->findAll();

        //Show customer
        $customer = $command->getCustomer();
        //Show Documents
        $documents = $command->getDocuments();
        //Show Sector
        $sector = $customer->getSector();

        return $this->render('@EasyMagOrder/command/show.html.twig', array(
            'customers' => $customers,
            'command' => $command,
            'customer' => $customer,
            'document' => $documents,
            'sector' => $sector,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing command entity.
     *
     * @param Command $command
     *
     * @Route("/{id}/edit", name = "command_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Command $command)
    {
        $deleteForm = $this->createDeleteForm($command);
        $editForm = $this->createForm('EasyMag\OrderBundle\Form\CommandType', $command);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('command_index');
        }

        return $this->render('@EasyMagOrder/command/edit.html.twig', array(
            'command' => $command,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a command entity.
     *
     * @param Command $command
     *
     * @Route("/{id}/delete", name = "command_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Command $command)
    {
        $form = $this->createDeleteForm($command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($command);
            $em->flush();
        }

        return $this->redirectToRoute('command_index');
    }

    /**
     * Creates a form to delete a command entity.
     *
     * @param Command $command The command entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Command $command)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('command_delete', array('id' => $command->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
