<?php
use Phalcon\Flash;
use Phalcon\Session;

class HistoryController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Your API call history');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
