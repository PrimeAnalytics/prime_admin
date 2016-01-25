<?php

namespace PRIME\Models;

class Computer extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var string
     */
    public $key;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $data;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var integer
     */
    public $organisation_id;



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
        return 'computer';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
