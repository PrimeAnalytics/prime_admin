<?php

namespace PRIME\Models;

class ProcessOperator extends \Phalcon\Mvc\Model
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
    public $form;

    /**
     *
     * @var string
     */
    public $script;

    /**
     *
     * @var string
     */
    public $assemblies;

    /**
     *
     * @var string
     */
    public $secondary_script;

    /**
     *
     * @var string
     */
    public $accessibility;

    /**
     *
     * @var string
     */
    public $icon;

    /**
     *
     * @var string
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
        return 'process_operator';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProcessOperator[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProcessOperator
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
