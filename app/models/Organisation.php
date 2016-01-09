<?php

namespace PRIME\Models;

class Organisation extends \Phalcon\Mvc\Model
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
    public $theme;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Dashboard', 'organisation_id', array('alias' => 'Dashboard'));
        $this->hasMany('id', 'DataConnector', 'organisation_id', array('alias' => 'DataConnector'));
        $this->hasMany('id', 'Login', 'organisation_id', array('alias' => 'Login'));
        $this->hasMany('id', 'OrgDatabase', 'organisation_id', array('alias' => 'OrgDatabase'));
        $this->hasMany('id', 'PaymentMethod', 'organisation_id', array('alias' => 'PaymentMethod'));
        $this->hasMany('id', 'PhysicalAddress', 'organisation_id', array('alias' => 'PhysicalAddress'));
        $this->hasMany('id', 'Process', 'organisation_id', array('alias' => 'Process'));
        $this->hasMany('id', 'ProcessOperator', 'organisation_id', array('alias' => 'ProcessOperator'));
        $this->hasMany('id', 'ProcessScheduled', 'organisation_id', array('alias' => 'ProcessScheduled'));
        $this->hasMany('id', 'SecurityGroup', 'organisation_id', array('alias' => 'SecurityGroup'));
        $this->hasMany('id', 'Users', 'organisation_id', array('alias' => 'Users'));
        $this->hasMany('id', 'Variables', 'organisation_id', array('alias' => 'Variables'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'organisation';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Organisation[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Organisation
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
