<?php

namespace PRIME\Models;

class UsersHasSecurityGroup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $users_email;

    /**
     *
     * @var integer
     */
    public $security_group_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('security_group_id', 'SecurityGroup', 'id', array('alias' => 'SecurityGroup'));
        $this->belongsTo('users_email', 'Users', 'email', array('alias' => 'Users'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users_has_security_group';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsersHasSecurityGroup[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsersHasSecurityGroup
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
