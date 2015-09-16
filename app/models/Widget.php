<?php

namespace PRIME\Models;

class Widget extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $width;

    /**
     *
     * @var integer
     */
    public $canvas_id;

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
     *
     * @var string
     */
    public $csv;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('canvas_id', 'PRIME\Models\Canvas', 'id', array('alias' => 'Canvas'));
        $this->belongsTo('dashboard_id', 'PRIME\Models\Dashboard', 'id', array('alias' => 'Dashboard'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'widget';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Widget[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Widget
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
