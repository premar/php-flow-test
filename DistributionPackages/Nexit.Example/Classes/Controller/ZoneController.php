<?php
namespace Nexit\Example\Controller;

/*
 * This file is part of the Nexit.Example package.
 */

use Exception;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Mvc\View\JsonView;
use Nexit\Example\Model\GenericRecord;
use Nexit\Example\Model\Zone;
use JMS\Serializer\SerializerBuilder as Builder;

class ZoneController extends ActionController
{
    protected $defaultViewObjectName = JsonView::class;

    /**
     * @throws Exception
     */
    public function indexAction()
    {
        $this->view->setConfiguration([
            'value' => [],
            'arrayvalue' => [
                '_descendAll' => [
                ]
            ],
        ]);

        $zone = new Zone();

        $zone->originDomain = 'example.com';
        $zone->addAddressRecord('@', '192.168.1.1', 300);
        $zone->addAddressRecord('test', '192.168.1.2', 300);

        $zone->addMailExchangeRecord('@', 'mail.example.com', 300, 10);

        $record = new GenericRecord('', 'ns1.example.com', 300);
        $record->setZone($zone);
        $zone->getNameServerRecords()->add($record);

        $serializer = Builder::create()->build();
        $jsonContent = $serializer->serialize($zone, 'json');

        $test = json_decode($jsonContent, true);

        #return $jsonContent;

        $this->view->assign("value", $zone);
    }
}
