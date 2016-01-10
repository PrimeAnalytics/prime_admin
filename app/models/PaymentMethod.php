<?php

namespace PRIME\Models;

class PaymentMethod extends \Phalcon\Mvc\Model
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
    public $company_registered_name;

    /**
     *
     * @var string
     */
    public $registration_number;

    /**
     *
     * @var string
     */
    public $vat_number;

    /**
     *
     * @var string
     */
    public $payment_method;

    /**
     *
     * @var string
     */
    public $billing_contact;

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
        $this->belongsTo('organisation_id', 'PRIME\Models\Organisation', 'id', array('alias' => 'Organisation'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'payment_method';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PaymentMethod[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PaymentMethod
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
