<?php

namespace Repair\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JMS\DiExtraBundle\Annotation as DI;

class NewsItemController extends Controller
{

    /**
     * @DI\Inject("doctrine.orm.entity_manager")
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @Route("/news/{id}")
     * @Template()
     */
    public function indexAction($id)
    {
        $newsItem = $this->entityManager
            ->getRepository('RepairNewsBundle:News')
            ->find($id);

        return array(
            'newsItem' => $newsItem
        );
    }
}
