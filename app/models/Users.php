<?php

namespace PRIME\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $full_name;

    /**
     *
     * @var string
     */
    public $parameters;

    /**
     *
     * @var string
     */
    public $image_path;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $role;

    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $organisation_id;

    /**
     *
     * @var string
     */
    public $registration_date;

    /**
     *
     * @var string
     */
    public $last_login;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }

        return true;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasManyToMany('email', 'PRIME\Models\DashboardHasUsers', 'users_email','dashboard_id','PRIME\Models\Dashboard','id',array('alias' => 'Dashboard'));
        $this->belongsTo('organisation_id', 'PRIME\Models\Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
