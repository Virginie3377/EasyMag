<?php

namespace EasyMag\OrderBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices' => ['Maquette' => 'maquette', 'Print' => 'print', 'Site Web' => 'command.web'],
                'required' => true,

            ))
            ->add('pubNumber', TextType::class, array(
                'label' => 'command.pubNumber',
                'property_path' => 'command_products.pubNumber'
            ))
            ->add('pubWidthSize', IntegerType::class, array(
                'label' => 'command.pubWidthSize',
                'property_path' => 'command_products.pubWidthSize'
            ))
            ->add('pubLengthSize', IntegerType::class, array(
                'label' => 'command.pubLengthSize',
                'property_path' => 'command_products.pubLengthSize'
            ))
            ->add('printName', TextType::class, array(
                'property_path' => 'command_products.printName'

            ))
            ->add('webName', TextType::class, array(
                'property_path' => 'command_products.webName'

            ))
            ->add('price', IntegerType::class, array(
                'property_path' => 'command_products.price'

            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EasyMag\OrderBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'easymag_orderbundle_product';
    }


}
