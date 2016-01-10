<?php

namespace PRIME\Models;

class ThemeLayout extends \Phalcon\Mvc\Model
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
    public $width;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'PRIME\Models\ThemeDashboard', 'theme_layout_id', array('alias' => 'ThemeDashboard'));
        $this->hasMany('id', 'PRIME\Models\ThemeLogin', 'theme_layout_id', array('alias' => 'ThemeLogin'));
        $this->hasMany('id', 'PRIME\Models\ThemePortlet', 'theme_layout_id', array('alias' => 'ThemePortlet'));
        $this->hasMany('id', 'PRIME\Models\ThemeWidget', 'theme_layout_id', array('alias' => 'ThemeWidget'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'theme_layout';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ThemeLayout[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ThemeLayout
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
