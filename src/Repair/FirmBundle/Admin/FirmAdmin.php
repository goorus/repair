<?php

namespace Repair\FirmBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class FirmAdmin extends Admin
{
    /**
     * Конфигурация отображения записи
     *
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array('label' => 'Идентификатор'))
            ->add('title', null, array('label' => 'Название фирмы'))
            ->add('contact', null, array('label' => 'Контакты'))
            ->add('description', null, array('label' => 'Описание'))
            ->add('publicTime', null, array('label' => 'Дата публикации'))
            ->add('owner', null, array('label' => 'Владелец'));
    }

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('label' => 'Название фирмы'))
            ->add('contact', null, array('label' => 'Контакты'))
            ->add('description', null, array('label' => 'Описание'))
            ->add('publicTime', null, array('label' => 'Дата публикации'))
            ->add('owner', null, array('label' => 'Владелец'))
            ->setHelps(array(
                'title' => 'Подсказка по заголовку',
                'publicTime' => 'Дата публикации на сайте'
            ));
    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('title', null, array('label' => 'Заголовок'))
            ->add('publicTime', null, array('label' => 'Дата публикации'))
            ->add('owner', null, array('label' => 'Владелец'));
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => 'Заголовок'));
    }

    /**
     * Конфигурация левого меню при отображении и редатировании записи
     *
     * @param \Knp\Menu\ItemInterface $menu
     * @param $action
     * @param \Sonata\AdminBundle\Admin\AdminInterface $childAdmin
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $menu->addChild(
            $action == 'edit' ? 'Просмотр фирмы' : 'Редактирование фирмы',
            array(
                'uri' => $this->generateUrl(
                    $action == 'edit' ? 'show' : 'edit',
                    array('id' => $this->getRequest()->get('id'))
                )
            )
        );
    }

}