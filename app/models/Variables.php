<?php

namespace PRIME\Models;

class Variables extends \Phalcon\Mvc\Model
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
    public $values;

    /**
     *
     * @var integer
     */
    public $organisation_id;

    /**
     *
     * @var string
     */
    public $default_value;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'SecurityGroupHasVariables', 'variables_id', array('alias' => 'SecurityGroupHasVariables'));
        $this->hasMany('id', 'VariablesHasSecurityGroup', 'variables_id', array('alias' => 'VariablesHasSecurityGroup'));
        $this->belongsTo('organisation_id', 'Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'variables';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Variables[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Variables
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
