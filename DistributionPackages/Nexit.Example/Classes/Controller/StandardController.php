<?php
namespace Nexit\Example\Controller;

/*
 * This file is part of the Nexit.Example package.
 */

use Neos\Flow\Mvc\Controller\ActionController;

class StandardController extends ActionController
{
    public function indexAction(): string
    {
        return "API Endpoint";
    }
}
