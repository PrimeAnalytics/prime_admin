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
        $this->hasMany('id', 'PRIME\Models\Dashboard', 'organisation_id', array('alias' => 'Dashboard'));
        $this->hasMany('id', 'PRIME\Models\DataConnector', 'organisation_id', array('alias' => 'DataConnector'));
        $this->hasMany('id', 'PRIME\Models\Login', 'organisation_id', array('alias' => 'Login'));
        $this->hasMany('id', 'PRIME\Models\OrgDatabase', 'organisation_id', array('alias' => 'OrgDatabase'));
        $this->hasMany('id', 'PRIME\Models\PaymentMethod', 'organisation_id', array('alias' => 'PaymentMethod'));
        $this->hasMany('id', 'PRIME\Models\PhysicalAddress', 'organisation_id', array('alias' => 'PhysicalAddress'));
        $this->hasMany('id', 'PRIME\Models\Process', 'organisation_id', array('alias' => 'Process'));
        $this->hasMany('id', 'PRIME\Models\ProcessOperator', 'organisation_id', array('alias' => 'ProcessOperator'));
        $this->hasMany('id', 'PRIME\Models\ProcessScheduled', 'organisation_id', array('alias' => 'ProcessScheduled'));
        $this->hasMany('id', 'PRIME\Models\SecurityGroup', 'organisation_id', array('alias' => 'SecurityGroup'));
        $this->hasMany('id', 'PRIME\Models\Users', 'organisation_id', array('alias' => 'Users'));
        $this->hasMany('id', 'PRIME\Models\Variables', 'organisation_id', array('alias' => 'Variables'));
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
