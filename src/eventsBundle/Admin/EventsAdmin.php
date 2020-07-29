<?php

namespace eventsBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EventsAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('nomEvent')
            ->add('localisationEvent')
            ->add('prixEvent')
            ->add('dateEvent')
            ->add('placeDispo')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('nomEvent')
            ->add('localisationEvent')
            ->add('prixEvent')
            ->add('dateEvent')
            ->add('placeDispo')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('nomEvent')
            ->add('localisationEvent')
            ->add('prixEvent')
            ->add('dateEvent')
            ->add('placeDispo')
            ->add('category')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('nomEvent')
            ->add('localisationEvent')
            ->add('prixEvent')
            ->add('dateEvent')
            ->add('placeDispo')
            ->add('category')
            ->add('inscriptions')
        ;
    }
}
