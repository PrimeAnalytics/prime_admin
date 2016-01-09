<?php

namespace PRIME\Models;

class OrgDatabase extends \Phalcon\Mvc\Model
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
    public $db_host;

    /**
     *
     * @var string
     */
    public $db_username;

    /**
     *
     * @var string
     */
    public $db_password;

    /**
     *
     * @var string
     */
    public $db_name;

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
        $this->hasMany('id', 'OrgDatabaseTable', 'org_database_id', array('alias' => 'OrgDatabaseTable'));
        $this->belongsTo('organisation_id', 'Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'org_database';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrgDatabase[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrgDatabase
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
