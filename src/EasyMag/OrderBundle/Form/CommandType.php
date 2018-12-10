<?php

namespace EasyMag\OrderBundle\Form;

use EasyMag\OrderBundle\Entity\Command;
use EasyMag\OrderBundle\Form\SectorType;
use EasyMag\OrderBundle\Repository\SectorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
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
            ->add('commandnumber')
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'command.date',
                'required' => false,
            ))
           ->add('status', ChoiceType::class, array(
                'label' => 'command.status',
                'choices' => Command::$civilites,

            ))
            ->add('product', ProductType::class, array(
                'label' => false,

            ))
            ->add('sector', EntityType::class, array(
                'class' => 'EasyMag\OrderBundle\Entity\Sector',
                'choice_label' => 'name',

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
