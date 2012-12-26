<?php

namespace Repair\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JMS\DiExtraBundle\Annotation as DI;

class NewsListController extends Controller
{

    /**
     * @DI\Inject("doctrine.orm.entity_manager")
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @Route("/news")
     * @Template()
     */
    public function indexAction()
    {
        $news = $this->entityManager
            ->getRepository('RepairNewsBundle:News')
            ->findBy(
                array(),
                array('id' => 'desc')
            );

        return array(
            'news' => $news
        );
    }
}
