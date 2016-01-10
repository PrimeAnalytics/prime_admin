<?php

namespace PRIME\Models;

class ProcessScheduled extends \Phalcon\Mvc\Model
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
    public $description;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasManyToMany('id', 'PRIME\Models\SecurityGroupHasProcessScheduled', 'process_scheduled_id','security_group_id','PRIME\Models\SecurityGroup','id',array('alias' => 'SecurityGroup'));
        $this->belongsTo('organisation_id', 'PRIME\Models\Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'process_scheduled';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProcessScheduled[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProcessScheduled
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
