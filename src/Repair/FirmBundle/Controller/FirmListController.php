<?php

namespace Repair\FirmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JMS\DiExtraBundle\Annotation as DI;

class FirmListController extends Controller
{

    /**
     * @DI\Inject("doctrine.orm.entity_manager")
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @Route("/firms")
     * @Template()
     */
    public function indexAction()
    {
        $firms = $this->entityManager
            ->getRepository('RepairFirmBundle:Firm')
            ->findBy(
                array(),
                array('id' => 'desc')
            );

        return array(
            'firms' => $firms
        );
    }
}
