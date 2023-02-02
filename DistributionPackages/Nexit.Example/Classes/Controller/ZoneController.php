<?php
namespace Nexit\Example\Controller;

/*
 * This file is part of the Nexit.Example package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class ZoneController extends ActionController
{
    public function indexAction()
    {
        return "Zone";
    }
}
