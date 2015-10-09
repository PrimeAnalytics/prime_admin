<?php

namespace PRIME\Models;

class Dashboard extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $icon;

    /**
     *
     * @var integer
     */
    public $weight;

    /**
     *
     * @var integer
     */
    public $organisation_id;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $parameters;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'PRIME\Models\Portlet', 'dashboard_id', array('alias' => 'Portlet'));
        $this->hasMany('id', 'PRIME\Models\DashboardHasUsers', 'dashboard_id', array('alias' => 'DashboardHasUsers'));
        $this->hasMany('id', 'PRIME\Models\Widget', 'dashboard_id', array('alias' => 'Widget'));
        $this->belongsTo('organisation_id', 'PRIME\Models\Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'dashboard';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Dashboard[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Dashboard
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
