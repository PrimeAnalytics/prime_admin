<?php

namespace PRIME\Models;

class Portlet extends \Phalcon\Mvc\Model
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
    public $type;

    /**
     *
     * @var integer
     */
    public $column;

    /**
     *
     * @var integer
     */
    public $row;

    /**
     *
     * @var integer
     */
    public $dashboard_id;

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
        $this->hasMany('id', 'Widget', 'portlet_id', array('alias' => 'Widget'));
        $this->belongsTo('dashboard_id', 'Dashboard', 'id', array('alias' => 'Dashboard'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'portlet';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Portlet[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Portlet
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
