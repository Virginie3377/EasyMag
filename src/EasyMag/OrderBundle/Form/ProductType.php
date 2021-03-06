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
                'choices' => ['Maquette' => 'Maquette', 'Print' => 'print', 'Web' => 'web'],
                'label_attr' => array(
                    'class'=> 'col-sm-2 control-label'
                ),
                'attr' => array(
                    'class'=> 'col-sm-3 form-control',
                    'style' =>'margin-left:5px; width:82%; border-radius: 4px;'
                ),
                'required' => true
            ))
            ->add('pubNumber', TextType::class, array(
                'label' => 'command.pubNumber',
                'label_attr' => array(
                    'class'=> 'col-sm-2 control-label',
                    'style' =>'margin-top:10px;'
                ),
                'attr' => array(
                    'class'=> 'col-sm-3 form-control',
                    'style' =>'display:block; margin-top:10px; margin-left:5px; width:82%; border-radius: 4px;',
                    'placeholder' => 'command.number'),

            ))
            ->add('pubWidthSize', IntegerType::class, array(
                'label' => 'command.pubWidthSize',
                'label_attr' => array(
                    'class'=> 'col-xs-2 control-label',
                    'style' =>'margin-top:10px;'
                ),
                'attr' => array(
                    'class'=> 'col-xs-3 form-control',
                    'style' =>'display:block; margin-top:10px; margin-left:5px; width:82%; border-radius: 4px;',
                )))
            ->add('pubLengthSize', IntegerType::class, array(
                'label' => 'command.pubLengthSize',
                'label_attr' => array(
                    'class'=> 'col-xs-2 control-label',
                    'style' =>'margin-top:10px;'
                ),
                'attr' => array(
                    'class'=> 'col-xs-3 form-control',
                    'style' =>'display:block; margin-top:10px; margin-left:5px; width:82%; border-radius: 4px;',
                )))

            ->add('printName', TextType::class, array(
                'label' => 'command.print',
                'label_attr' => array('class'=> 'col-xs-2 control-label', 'style' =>'margin-top:10px;'),
                'attr' => array(
                    'class'=> 'col-xs-3 form-control',
                    'style' =>'margin-top:10px; margin-left:5px; width:82%; border-radius: 4px;',
                    'placeholder' => 'command.size',
                ),
                'required' => false
                ))

            ->add('webName', TextType::class, array(
                'label' => 'command.web',
                'label_attr' => array('class'=> 'col-xs-2 control-label', 'style' =>'margin-top:10px;'),
                'attr' => array(
                    'class'=> 'col-xs-3 form-control',
                    'style' =>'display:block; margin-top:10px; margin-left:5px; width:82%; border-radius: 4px;',
                ),
                'required' => false
            ))

            ->add('price', TextType::class, array(
                'label' => 'command.price',
                'label_attr' => array('class'=> 'col-xs-2 control-label', 'style' =>'margin-top:10px;'),
                'attr' => array(
                    'class'=> 'col-xs-3 form-control',
                    'style' =>'display:block; margin-top:10px; margin-left:5px; width:82%; border-radius: 4px;',

            )));
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
