<?php

namespace PRIME\Models;

class SecurityGroupHasOrgDatabaseTable extends \Phalcon\Mvc\Model
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
    public $org_database_table_id;

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
        $this->belongsTo('org_database_table_id', 'OrgDatabaseTable', 'id', array('alias' => 'OrgDatabaseTable'));
        $this->belongsTo('security_group_id', 'SecurityGroup', 'id', array('alias' => 'SecurityGroup'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'security_group_has_org_database_table';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SecurityGroupHasOrgDatabaseTable[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SecurityGroupHasOrgDatabaseTable
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
