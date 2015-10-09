<?php

namespace PRIME\Models;

class ThemeLogin extends \Phalcon\Mvc\Model
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
    public $html;

    /**
     *
     * @var string
     */
    public $js;

    /**
     *
     * @var string
     */
    public $css;

    /**
     *
     * @var string
     */
    public $script;

    /**
     *
     * @var string
     */
    public $style;

    /**
     *
     * @var string
     */
    public $form;

    /**
     *
     * @var integer
     */
    public $theme_layout_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('theme_layout_id', 'PRIME\Models\ThemeLayout', 'id', array('alias' => 'ThemeLayout'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'theme_login';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ThemeDashboard[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ThemeDashboard
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
