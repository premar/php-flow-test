<?php
namespace Nexit\Example\Controller;

/*
 * This file is part of the Nexit.Example package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class StandardController extends ActionController
{

    protected $defaultViewObjectName = \Neos\Flow\Mvc\View\JsonView::class;

    public function showAction()
    {
        $this->view->assign('value', 'foobar');
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('value', 'foobar');
    }
}