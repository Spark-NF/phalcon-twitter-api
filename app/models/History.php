<?php
use Phalcon\Mvc\Model;

class History extends Model
{
    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var DateTime
     */
    public $date;

    /**
     * @var integer
     */
    public $calls;

    /**
     * History initializer
     */
    public function initialize()
    {
        $this->belongsTo('user_id', 'Users', 'id', array('reusable' => true));
    }

}
