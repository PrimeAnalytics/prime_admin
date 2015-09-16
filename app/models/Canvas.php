<?php

namespace PRIME\Models;

class Canvas extends \Phalcon\Mvc\Model
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
    public $style;

    /**
     *
     * @var string
     */
    public $width;

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
        $this->hasMany('id', 'PRIME\Models\Widget', 'canvas_id', array('alias' => 'Widget'));
        $this->belongsTo('dashboard_id', 'PRIME\Models\Dashboard', 'id', array('alias' => 'Dashboard'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'canvas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Canvas[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Canvas
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
