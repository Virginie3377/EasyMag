<?php

namespace EasyMag\OrderBundle\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\MultiselectColumn;
use Sg\DatatablesBundle\Datatable\Column\VirtualColumn;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Column\ImageColumn;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Filter\NumberFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Editable\CombodateEditable;
use Sg\DatatablesBundle\Datatable\Editable\SelectEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextareaEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextEditable;

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
            'cdn_language_by_locale' => true
            //'language' => 'de'
        ));

        $this->ajax->set(array(
        ));

        $this->options->set(array(
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'order_cells_top' => true,
        ));

        $this->features->set(array(
        ));

        $this->columnBuilder
            ->add('id', Column::class, array(
                'title' => 'Id',
                ))
            ->add('date', DateTimeColumn::class, array(
                'title' => 'Date',
                ))
            ->add('status', Column::class, array(
                'title' => 'Status',
                ))
            ->add('customer.id', Column::class, array(
                'title' => 'Customer Id',
                ))
            ->add('customer.company', Column::class, array(
                'title' => 'Customer Company',
                ))
            ->add('customer.address', Column::class, array(
                'title' => 'Customer Address',
                ))
            ->add('customer.postalCode', Column::class, array(
                'title' => 'Customer PostalCode',
                ))
            ->add('customer.city', Column::class, array(
                'title' => 'Customer City',
                ))
            ->add('customer.phone', Column::class, array(
                'title' => 'Customer Phone',
                ))
            ->add('customer.email', Column::class, array(
                'title' => 'Customer Email',
                ))
            ->add('customer.gender', Column::class, array(
                'title' => 'Customer Gender',
                ))
            ->add('customer.lastname', Column::class, array(
                'title' => 'Customer Lastname',
                ))
            ->add('customer.firstname', Column::class, array(
                'title' => 'Customer Firstname',
                ))
            ->add('customer.customer', Column::class, array(
                'title' => 'Customer Customer',
                ))
            ->add('customer.createdAt', Column::class, array(
                'title' => 'Customer CreatedAt',
                ))
            ->add('customer.image', Column::class, array(
                'title' => 'Customer Image',
                ))
            ->add('documents.id', Column::class, array(
                'title' => 'Documents Id',
                'data' => 'documents[, ].id'
                ))
            ->add('documents.type', Column::class, array(
                'title' => 'Documents Type',
                'data' => 'documents[, ].type'
                ))
            ->add('documents.createdAt', Column::class, array(
                'title' => 'Documents CreatedAt',
                'data' => 'documents[, ].createdAt'
                ))
            ->add('documents.nom', Column::class, array(
                'title' => 'Documents Nom',
                'data' => 'documents[, ].nom'
                ))
            ->add('product.id', Column::class, array(
                'title' => 'Product Id',
                ))
            ->add('product.type', Column::class, array(
                'title' => 'Product Type',
                ))
            ->add('product.pubNumber', Column::class, array(
                'title' => 'Product PubNumber',
                ))
            ->add('product.pubLengthSize', Column::class, array(
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
                ))
            ->add('product.price', Column::class, array(
                'title' => 'Product Price',
                ))
            ->add(null, ActionColumn::class, array(
                'title' => $this->translator->trans('sg.datatables.actions.title'),
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
