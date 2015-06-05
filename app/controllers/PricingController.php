<?php
class PricingController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Pricing');
        parent::initialize();
    }

    public function indexAction()
    {}
}
