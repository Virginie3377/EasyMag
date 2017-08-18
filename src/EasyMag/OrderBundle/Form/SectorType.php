<?php

namespace EasyMag\OrderBundle\Form;

use EasyMag\OrderBundle\Entity\Sector;
use EasyMag\UserBundle\Entity\Commercial;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectorType extends AbstractType
{
    private $container;


    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->container->get('doctrine')->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $commercial = $em->getRepository(Commercial::class)->findOneByUser($user);
        $sectors = $commercial->getSectors();

        $builder
            ->add('name', ChoiceType::class, array(
                'choices' => $sectors,
                'choice_label' => function ($sector) {
                    return $sector->getName();
                },
                'label' => 'sector._',

            ))
            ->add('periodicity', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'sector.publication',
                'required' => false,
            ))
           ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Sector::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'easymag_orderbundle_sector';
    }


}
