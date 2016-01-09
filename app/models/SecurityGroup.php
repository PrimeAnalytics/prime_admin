<?php

namespace PRIME\Models;

class SecurityGroup extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $organisation_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasManyToMany('id', 'PRIME\Models\SecurityGroupHasDashboard', 'security_group_id','dashboard_id','PRIME\Models\Dashboard','id',array('alias' => 'Dashboard'));
        $this->hasManyToMany('id', 'PRIME\Models\SecurityGroupHasOrgDatabaseTable', 'security_group_id','org_database_table_id','PRIME\Models\OrgDatabaseTable','id',array('alias' => 'OrgDatabaseTable'));
        $this->hasManyToMany('id', 'PRIME\Models\SecurityGroupHasProcess', 'security_group_id','process_id','PRIME\Models\Process','id',array('alias' => 'Process'));
        $this->hasManyToMany('id', 'PRIME\Models\SecurityGroupHasProcessScheduled', 'security_group_id','process_scheduled_id','PRIME\Models\ProcessScheduled','id',array('alias' => 'ProcessScheduled'));
        $this->hasManyToMany('id', 'PRIME\Models\SecurityGroupHasVariables', 'security_group_id','variables_id','PRIME\Models\Variables','id',array('alias' => 'Variables'));
        $this->hasManyToMany('id', 'PRIME\Models\UsersHasSecurityGroup', 'security_group_id','users_email','PRIME\Models\Users','id',array('alias' => 'Users'));

        $this->belongsTo('organisation_id', 'Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'security_group';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SecurityGroup[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SecurityGroup
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
