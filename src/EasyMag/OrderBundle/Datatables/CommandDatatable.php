<?php

namespace EasyMag\OrderBundle\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;


/**
 * Class CommandDatatable
 *
 * @package EasyMag\OrderBundle\Datatables
 */
class CommandDatatable extends AbstractDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->language->set(array(
            'language' => 'fr'
        ));

        $this->ajax->set(array(
            'type' => 'POST',

        ));

        $this->options->set(array(
            'classes' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'order_cells_top' => true,
        ));

        $this->features->set(array(
            'processing' => true,
        ));

        $this->columnBuilder
            ->add('id',Column::class, array(
                'title' => $this->translator->trans('command.id'),
                'width'=> '20px',
            ))
            ->add('commandnumber', Column::class, array(
                'title' => $this->translator->trans('command.commandnumber'),
                'width'=> '70px',
            ))
            ->add('customer.company',Column::class, array(
                'title' => $this->translator->trans('profile.fields.company'),
                'width'=> '100px',
                'filter' => array(TextFilter::class, array(
                    'search_type' => 'like',
                ))))
            ->add('date', DateTimeColumn::class, array(
                'title' => 'Date',
                'width'=> '70px',
            ))
            ->add('status', Column::class, array(
                'title' => $this->translator->trans('command.status'),
                'width'=> '100px',
                'searchable'=> true,
                'orderable' => true,
                'filter' => array(SelectFilter::class, array(
                    'search_type' => 'eq',
                    'select_options' => array(
                        '' =>$this->translator->trans('datatable.all'),
                        '0' =>$this->translator->trans('command.in_progress'),
                        '1' =>$this->translator->trans('command.validate')
                    ),
                ))))

            /* ->add('customer.sector', Column::class, array(
                'title' => $this->translator->trans('sector._'),
                'width'=> '90px',
                'filter' => array(TextFilter::class, array(
                    'search_type' => 'like',

                ))))

             ->add('customer.phone', Column::class, array(
                 'title' => $this->translator->trans('profile.fields.phone'),

                 ))
             ->add('customer.email', Column::class, array(
                 'title' => 'Customer Email',
                 ))


             ->add('documents.type', Column::class, array(
                 'title' => 'Documents Type',
                 'data' => 'documents[, ].type'
                 ))
             ->add('documents.nom', Column::class, array(
                 'title' => 'Documents Nom',
                 'data' => 'documents[, ].nom'
                 ))*/

            ->add('product.type', Column::class, array(
                'title' => $this->translator->trans('product._'),
                'width'=> '110px',
                'searchable'=> true,
                'orderable' => true,
                'filter' => array(SelectFilter::class, array(
                    'search_type' => 'eq',
                    'select_options' => array(
                        '' =>$this->translator->trans('command.maquette'),
                        '0' =>$this->translator->trans('command.print'),
                        '1' =>$this->translator->trans('command.web')
                    ),
                ))))
            ->add('product.pubNumber', Column::class, array(
                'title' => $this->translator->trans('product.number'),
                'width'=> '60px',
                ))
            /* ->add('product.pubLengthSize', Column::class, array(
                 'title' => 'Product PubLengthSize',
                 ))
             ->add('product.pubWidthSize', Column::class, array(
                 'title' => 'Product PubWidthSize',
                 ))
             ->add('product.printName', Column::class, array(
                 'title' => 'Product PrintName',
                 ))
             ->add('product.webName', Column::class, array(
                 'title' => 'Product WebName',
                 ))*/
            ->add('product.price', Column::class, array(
                'title' => $this->translator->trans('product.price'),
                'width'=> '60px',
                ))
            ->add(null, ActionColumn::class, array(
                'title' => $this->translator->trans('sg.datatables.actions.title'),
                'width'=> '110px',
                'actions' => array(
                    array(
                        'route' => 'command_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => $this->translator->trans('sg.datatables.actions.show'),
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.show'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'command_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => $this->translator->trans('sg.datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.edit'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'EasyMag\OrderBundle\Entity\Command';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'command_datatable';
    }
}
