<?php

namespace PRIME\Models;

class DashboardHasUsers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $dashboard_id;

    /**
     *
     * @var string
     */
    public $users_email;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('dashboard_id', 'PRIME\Models\Dashboard', 'id', array('alias' => 'Dashboard'));
        $this->belongsTo('users_email', 'PRIME\Models\Users', 'email', array('alias' => 'Users'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'dashboard_has_users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DashboardHasUsers[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DashboardHasUsers
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
