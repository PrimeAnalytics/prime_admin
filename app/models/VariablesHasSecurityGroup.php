<?php

namespace PRIME\Models;

class VariablesHasSecurityGroup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $variables_id;

    /**
     *
     * @var integer
     */
    public $security_group_id;

    /**
     *
     * @var string
     */
    public $read_write;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('security_group_id', 'SecurityGroup', 'id', array('alias' => 'SecurityGroup'));
        $this->belongsTo('variables_id', 'Variables', 'id', array('alias' => 'Variables'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'variables_has_security_group';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VariablesHasSecurityGroup[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VariablesHasSecurityGroup
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
