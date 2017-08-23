<?php

namespace EasyMag\OrderBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', TextType::class, array(
                'required' => true,
            ))
            ->add('address', TextType::class, array(
                'required' => true,
            ))
            ->add('postalCode')
            ->add('city')
            ->add('phone')
            ->add('email')
            ->add('gender', ChoiceType::class, array(
                'choices' => [' ' => ' ', 'Mr' => 'Mr', 'Me' => 'Me', 'Mle'=>'Mle'],
                'required' => false,
            ))
            ->add('lastname')
            ->add('firstname')
            ->add('customer', ChoiceType::class, array(
                'choices'=> ['client'=> true],
                'multiple' => false,
                'expanded' => true,
            ))
            ->add('sector', EntityType::class, array(
                'class' => 'EasyMag\OrderBundle\Entity\Sector',
               'property_path' => 'sector',

            ))
    /*        ->add('commercial')
            ->add('graphiste')*/
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
