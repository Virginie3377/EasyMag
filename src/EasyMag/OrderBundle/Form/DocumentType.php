<?php

namespace EasyMag\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            'data_class' => 'EasyMag\OrderBundle\Entity\Document'
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
