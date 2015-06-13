<?php

use Phalcon\Flash;
use Phalcon\Session;

class InvoicesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your Invoices');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
