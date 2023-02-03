<?php
namespace Nexit\Example\Controller;

/*
 * This file is part of the Nexit.Example package.
 */

use Exception;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Mvc\View\JsonView;
use Nexit\Example\Model\Zone;

class ZoneController extends ActionController
{
    protected $defaultViewObjectName = JsonView::class;

    /**
     * @throws Exception
     */
    public function indexAction()
    {
        $zone = new Zone();

        $zone->origin = 'example.com';
        $zone->addARecord('@', '192.168.1.1', 300);
        $zone->addARecord('test', '192.168.1.2', 300);

        $zone->addMxRecord('@', 'mail.example.com', 300, 10);

        $zone->addNsRecord('ns1.example.com');

        $this->view->assign('value', $zone);
    }
}
