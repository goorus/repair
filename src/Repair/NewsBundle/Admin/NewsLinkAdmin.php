<?php

namespace Repair\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 *
 * Административный класс для ссылок новостей содержит только
 * метод configureFormFields, т.к. ссылки новостей редактируются
 * вместе с новостью.
 *
 */
class NewsLinkAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('url', null, array('label' => 'URL', 'required' => true))
                ->add('text', null, array('label' => 'Описание'));
    }
}