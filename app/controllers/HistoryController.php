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

    protected function getLast($time)
    {
        $date = new DateTime();
        $date->sub(new DateInterval('P'.$time));
        $history = History::find(array(
            'user_id = :user_id: AND date > :date:',
            "order" => "date DESC",
            'bind' => array('user_id' => 1, 'date' => $date->format('Y-m-d'))
        ));

        return $history;
    }

    public function indexAction()
    {
        $this->view->history = $this->getLast('3M');
    }

    public function weeklyAction()
    {
        $this->view->history = $this->getLast('1W');
    }

    public function monthlyAction()
    {
        $this->view->history = $this->getLast('1M');
    }

    public function dailyAction()
    {
        $this->view->history = $this->getLast('1D');
    }
}
