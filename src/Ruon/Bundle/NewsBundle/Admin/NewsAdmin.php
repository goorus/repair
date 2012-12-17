<?php

namespace Ruon\Bundle\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class NewsAdmin extends Admin
{
    /**
     * Конфигурация отображения записи
     *
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
                ->add('id', null, array('label' => 'Идентификатор'))
                ->add('title', null, array('label' => 'Заголовок'))
                ->add('announce', null, array('label' => 'Анонс'))
                ->add('text', null, array('label' => 'Текст'))
                ->add('pubDate', null, array('label' => 'Дата публикации'))
                ->add('newsLinks', null, array('label' => 'Ссылки к новости'))
                ->add('newsCategory', null, array('label' => 'Идентификатор'));
    }

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('label' => 'Заголовок'))
                ->add('announce', null, array('label' => 'Анонс'))
                ->add('text', null, array('label' => 'Текст'))
                ->add('pubDate', null, array('label' => 'Дата публикации'))

        //by_reference используется для того чтобы при трансформации данных запроса в объект сущности
        //которую выполняет Symfony Form Framework, использовался setter сущности News::setNewsLinks
                ->add('newsLinks', 'sonata_type_collection',
                      array('label' => 'Ссылки', 'by_reference' => false),
                      array(
                           'edit' => 'inline',
                           //В сущности NewsLink есть поле pos, отражающее положение ссылки в списке
                          //указание опции sortable позволяет менять положение ссылок в списке перетаскиваением
                           'sortable' => 'pos',
                           'inline' => 'table',
                      ))
                ->add('newsCategory', null, array('label' => 'Категория'))
                ->setHelps(array(
                                'title' => 'Подсказка по заголовку',
                                'pubDate' => 'Дата публикации новости на сайте'
                           ));
    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('id')
                ->addIdentifier('title', null, array('label' => 'Заголовок'))
                ->add('pubDate', null, array('label' => 'Дата публикации'))
                ->add('newsCategory', null, array('label' => 'Категория'));
    }

    /**
     * Поля, по которым производится поиск в списке записей
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
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
            $action == 'edit' ? 'Просмотр новости' : 'Редактирование новости',
            array('uri' => $this->generateUrl(
                $action == 'edit' ? 'show' : 'edit', array('id' => $this->getRequest()->get('id'))))
        );
    }

}