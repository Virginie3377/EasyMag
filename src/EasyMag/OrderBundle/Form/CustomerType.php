<?php

namespace EasyMag\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', TextType::class, array(
                'label' => 'profile.fields.company',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                
            ))

            ->add('address')
            ->add('postalCode')
            ->add('city')
            ->add('phone')
            ->add('email')
            ->add('gender')
            ->add('lastname')
            ->add('firstname')
            ->add('customer')
            ->add('sector', SectorType::class)
            ->add('commercial')
            ->add('graphiste');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EasyMag\OrderBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'easymag_orderbundle_customer';
    }


}
