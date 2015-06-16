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

        $h = array();
        $max = 0;
        foreach ($history as $val) {
            $h[] = $val;
            $max = $val->calls > $max ? $val->calls : $max;
        }
        krsort($h);

        $this->view->history = $h;
        $this->view->max = $max;

        $widths = array(5, 10, 20, 50, 100, 200, 500, 1000);
        $i = 0;
        do {
            $sw = $widths[$i];
            $i++;
        } while ($max / $sw >= 10);

        $this->view->stepWidth = $sw;
        $this->view->steps = ceil($max / $sw);
    }

    public function indexAction()
    {
        $this->getLast('3M');
    }

    public function weeklyAction()
    {
        $this->getLast('1W');
    }

    public function monthlyAction()
    {
        $this->getLast('1M');
    }

    public function dailyAction()
    {
        $this->getLast('1D');
    }
}
