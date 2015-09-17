<?php

namespace Grumpydictator\NestOauth2Provider\Provider;

/**
 * Class SmokeCoAlarm
 *
 * @package Grumpydictator\NestOauth2Provider\Provider
 */
class SmokeCoAlarm
{
    public $device_id;
    public $locale;
    public $software_version;
    public $structure_id;
    public $name;
    public $name_long;
    public $last_connection;
    public $is_online;
    public $battery_health;
    public $co_alarm_state;
    public $smoke_alarm_state;
    public $is_manual_test_active;
    public $last_manual_test_time;
    public $ui_color_state;

    /**
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        $this->device_id             = isset($data->device_id) ? $data->device_id : null;
        $this->locale                = isset($data->locale) ? $data->locale : null;
        $this->software_version      = isset($data->software_version) ? $data->software_version : null;
        $this->structure_id          = isset($data->structure_id) ? $data->structure_id : null;
        $this->name                  = isset($data->name) ? $data->name : null;
        $this->name_long             = isset($data->name_long) ? $data->name_long : null;
        $this->last_connection       = isset($data->last_connection) ? $data->last_connection : null;
        $this->is_online             = isset($data->is_online) ? (bool)$data->is_online : null;
        $this->battery_health        = isset($data->battery_health) ? $data->battery_health : null;
        $this->co_alarm_state        = isset($data->co_alarm_state) ? $data->co_alarm_state : null;
        $this->smoke_alarm_state     = isset($data->smoke_alarm_state) ? $data->smoke_alarm_state : null;
        $this->is_manual_test_active = isset($data->is_manual_test_active) ? (bool)$data->is_manual_test_active : null;
        $this->last_manual_test_time = isset($data->last_manual_test_time) ? new \DateTime($data->last_manual_test_time) : null;
        $this->ui_color_state        = isset($data->ui_color_state) ? $data->ui_color_state : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'device_id'             => $this->device_id,
            'locale'                => $this->locale,
            'software_version'      => $this->software_version,
            'structure_id'          => $this->structure_id,
            'name'                  => $this->name,
            'name_long'             => $this->name_long,
            'last_connection'       => $this->last_connection,
            'is_online'             => $this->is_online,
            'battery_health'        => $this->battery_health,
            'co_alarm_state'        => $this->co_alarm_state,
            'smoke_alarm_state'     => $this->smoke_alarm_state,
            'is_manual_test_active' => $this->is_manual_test_active,
            'last_manual_test_time' => $this->last_manual_test_time,
            'ui_color_state'        => $this->ui_color_state,
        ];
    }

}