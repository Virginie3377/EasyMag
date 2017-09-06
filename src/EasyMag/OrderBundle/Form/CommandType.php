<?php

namespace EasyMag\OrderBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer')
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'command.date',
                'required' => false,
            ))
           ->add('status', ChoiceType::class, array(
                'label' => 'command.status',
                'choices' => array(
                    'command.in_progress' => 'En cours',
                    'command.validate' => 'Validé',
            ),
            ))
            ->add('product', CollectionType::class, array(
                'entry_type' => ProductType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'product._'
            ))
            ->add('submit',SubmitType::class, array(
                'label' => 'Enregistrer'
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EasyMag\OrderBundle\Entity\Command'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'easymag_orderbundle_command';
    }


}
