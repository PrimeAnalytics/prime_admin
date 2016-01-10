<?php

namespace PRIME\Models;

class SecurityGroupHasProcess extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $security_group_id;

    /**
     *
     * @var integer
     */
    public $process_id;

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
        $this->belongsTo('process_id', 'PRIME\Models\Process', 'id', array('alias' => 'Process'));
        $this->belongsTo('security_group_id', 'PRIME\Models\SecurityGroup', 'id', array('alias' => 'SecurityGroup'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'security_group_has_process';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SecurityGroupHasProcess[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SecurityGroupHasProcess
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
