<?php

namespace EasyMag\OrderBundle\Form;


use EasyMag\OrderBundle\Entity\Command;
use EasyMag\OrderBundle\Entity\Customer;
use EasyMag\OrderBundle\Entity\Document;
use EasyMag\OrderBundle\Repository\CommandRepository;
use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    private $container;
    private $command;

    public function __construct(ContainerInterface $container, SessionInterface $session)
    {
        $this->container = $container;
        $this->command = $this->container->get('session')->get('command');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->container->get('doctrine')->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $commercial = $em->getRepository(Commercial::class)->findOneByUser($user);

        $builder
           /* ->add('command', ChoiceType::class, array(
                'choices' => $command,
                'choice_label'=> function ($command) {
                    return $command->getCommandnumber();
                }
            ))*/
            ->add('command_id', TextType::class, array(
                'label' => 'document.command',
               'disabled' => false,
               'data' => $this->command,
               'mapped' => false,
            ))
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'document.bdc' => 'Bon de commande',
                    'document.bdf' => 'Bon de fabrication',
                    'document.devis' => 'Devis',
                    'document.facture' => 'Facture',
                    'document.autre' => 'Autre',
                ),
            ))
            ->add('nom', TextType::class, array(
                'label' => 'document.nom',

            ))
            ->add('createdAt', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'document.created',
                'required' => false,
            ))
            ->add('fichier', FileType::class, array(
                'label' => 'Fichier'
            ))
            ->add('submit',SubmitType::class, array(
                'label' => 'Enregistrer'
            ));
    }



    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Document::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'easymag_orderbundle_document';
    }


}
