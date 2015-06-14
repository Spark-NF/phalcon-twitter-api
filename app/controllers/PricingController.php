<?php
class PricingController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Pricing');
        parent::initialize();
    }

    public function indexAction()
    {
        $auth = $this->session->get('auth');

        if ($auth != null) {
            $user = Users::findFirst($auth['id']);
            $this->view->offer = $user !== false ? $user->offer : false;
        }
        else {
            $this->view->offer = false;
        }
    }

    public function switchAction()
    {
        $auth = $this->session->get('auth');

        $user = Users::findFirst($auth['id']);
        if ($user == false) {
            return $this->_forward('pricing/index');
        }

        $offer = $this->dispatcher->getParam(0);
        if (!in_array($offer, array('test', 'classic', 'premium'))) {
            $this->flash->error('Not a valid offer');
            return $this->forward('pricing/index');
        }

        $user->offer = $offer;
        if ($user->save() == false) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
        }
        else {
            $this->flash->success('Your offer has been changed successfully');
        }

        return $this->forward('pricing/index');
    }
}
