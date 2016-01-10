<?php

namespace PRIME\Models;

class DataConnector extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var string
     */
    public $parameters;

    /**
     *
     * @var string
     */
    public $storage;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('organisation_id', 'PRIME\Models\Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'data_connector';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DataConnector[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DataConnector
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
