<?php

namespace PRIME\Models;

class PhysicalAddress extends \Phalcon\Mvc\Model
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
    public $address;

    /**
     *
     * @var string
     */
    public $longitude;

    /**
     *
     * @var string
     */
    public $latitude;

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
        return 'physical_address';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PhysicalAddress[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PhysicalAddress
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
