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
        $date = new DateTime();
        $date->sub(new DateInterval('P3M'));
        $history = History::find(array(
            'user_id = :user_id: AND date >= :date:',
            "order" => "date DESC",
            'bind' => array('user_id' => 1, 'date' => $date->format('Y-m-d'))
        ));

        $this->view->history = $history;
    }
}
