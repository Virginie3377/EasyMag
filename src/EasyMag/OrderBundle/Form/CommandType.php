<?php

namespace EasyMag\OrderBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
//            ->add('status')
            ->add('commands_product', CollectionType::class, array(
                'entry_type' => Command_ProductType::class,
                'allow_add' => true,
                'allow_delete' => true,
                /*'label' => 'command.quantity',
                'property_path' => 'commands_product',
                'class' => 'EasyMag\OrderBundle\Entity\Command_Product',*/

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
