<?php

namespace PRIME\Models;

class OrgDatabaseTable extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $org_database_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'SecurityGroupHasOrgDatabaseTable', 'org_database_table_id', array('alias' => 'SecurityGroupHasOrgDatabaseTable'));
        $this->belongsTo('org_database_id', 'OrgDatabase', 'id', array('alias' => 'OrgDatabase'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'org_database_table';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrgDatabaseTable[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrgDatabaseTable
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
