<?php

namespace EasyMag\OrderBundle\Controller;

use EasyMag\OrderBundle\Entity\Document;
use EasyMag\OrderBundle\Form\DocumentType;
use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DocumentController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commerciaux = $em->getRepository(Commercial::class)->findOneByUser($this->getUser());

        $documents = $em->getRepository(Document::class)->findSyndicDocumentsSortedByDate($commerciaux);
        return $this->render('EasyMagOrderBundle:Document:index.html.twig', array(
            'documents' => $documents,
        ));
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commerciaux = $em->getRepository(Commercial::class)->findOneByUser($this->getUser());

        $document = new Document();
        $form_document = $this->createForm(DocumentType::class, $document);
        $form_document->handleRequest($request);
        $command = $document->getCommand();

        if ($form_document->isSubmitted() && $form_document->isValid()) {
            $document->setCommand($command);
            $document->setExtension($document->getFichier()->guessExtension());
            $em->persist($document);
            $em->flush();

            $this->addFlash('info', 'Un nouveau document a été importé avec succès.');
            return $this->redirectToRoute('command_show', array('id' => $document->getId()));
        }

        return $this->render('@EasyMagOrder/Document/new.html.twig', array(
            'form_document' => $form_document->createView(),
        ));
    }

    public function editAction(Request $request, Document $document)
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $document->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'Les modifications sur le document ont bien été enregistrées.');

            return $this->redirectToRoute('command_show', array(
                'id' => $document->getId(),
            ));
        }

        return $this->render('@EasyMagOrder/Document/edit.html.twig', array(
            'form_edit_document' => $form->createView(),
            'documentId' => $document->getId(),
        ));
    }

    public function showAction(Document $document)
    {
        return $this->render('@EasyMagOrder/command/show.html.twig', array(
            'document' => $document
        ));
    }

    public function deleteAction(Request $request, Document $document)
    {
        if ($document !== null) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Le document a bien été supprimé.');
            return $this->redirectToRoute('syndic_gestion_documents');
        }
        $request->getSession()->getFlashBag()->add('info', 'Le document n\'existe pas.');

        return $this->redirectToRoute('syndic_gestion_documents');
    }

}

