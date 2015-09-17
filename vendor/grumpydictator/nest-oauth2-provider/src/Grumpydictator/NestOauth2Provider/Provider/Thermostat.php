<?php

namespace Grumpydictator\NestOauth2Provider\Provider;

/**
 * Class Device
 *
 * @package Grumpydictator\NestOauth2Provider\Provider
 */
class Thermostat
{


    public $device_id;
    public $locale;
    public $software_version;
    public $structure_id;
    public $name;
    public $name_long;
    public $last_connection;
    public $is_online;
    public $can_cool;
    public $can_heat;
    public $is_using_emergency_heat;
    public $has_fan;
    public $fan_timer_active;
    public $fan_timer_timeout;
    public $has_leaf;
    public $temperature_scale;
    public $target_temperature_f;
    public $target_temperature_c;
    public $target_temperature_high_f;
    public $target_temperature_high_c;
    public $target_temperature_low_f;
    public $target_temperature_low_c;
    public $away_temperature_high_f;
    public $away_temperature_high_c;
    public $away_temperature_low_f;
    public $away_temperature_low_c;
    public $hvac_mode;
    public $ambient_temperature_f;
    public $ambient_temperature_c;
    public $humidity;

    /**
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {

        $this->device_id                 = isset($data->device_id) ? $data->device_id : null;
        $this->locale                    = isset($data->locale) ? $data->locale : null;
        $this->software_version          = isset($data->software_version) ? $data->software_version : null;
        $this->structure_id              = isset($data->structure_id) ? $data->structure_id : null;
        $this->name                      = isset($data->name) ? $data->name : null;
        $this->name_long                 = isset($data->name_long) ? $data->name_long : null;
        $this->last_connection           = isset($data->last_connection) ? new \DateTime($data->last_connection) : null;
        $this->is_online                 = isset($data->is_online) ? (bool)$data->is_online : null;
        $this->can_cool                  = isset($data->can_cool) ? (bool)$data->can_cool : null;
        $this->can_heat                  = isset($data->can_heat) ? (bool)$data->can_heat : null;
        $this->is_using_emergency_heat   = isset($data->is_using_emergency_heat) ? (bool)$data->is_using_emergency_heat : null;
        $this->has_fan                   = isset($data->has_fan) ? (bool)$data->has_fan : null;
        $this->fan_timer_active          = isset($data->fan_timer_active) ? (bool)$data->fan_timer_active : null;
        $this->fan_timer_timeout         = isset($data->fan_timer_timeout) ? new \DateTime($data->fan_timer_timeout) : null;
        $this->temperature_scale         = isset($data->temperature_scale) ? $data->temperature_scale : null;
        $this->target_temperature_f      = isset($data->target_temperature_f) ? intval($data->target_temperature_f) : null;
        $this->target_temperature_c      = isset($data->target_temperature_c) ? $data->target_temperature_c : null;
        $this->target_temperature_high_f = isset($data->target_temperature_high_f) ? intval($data->target_temperature_high_f) : null;
        $this->target_temperature_high_c = isset($data->target_temperature_high_c) ? floatval($data->target_temperature_high_c) : null;
        $this->target_temperature_low_f  = isset($data->target_temperature_low_f) ? intval($data->target_temperature_low_f) : null;
        $this->target_temperature_low_c  = isset($data->target_temperature_low_c) ? floatval($data->target_temperature_low_c) : null;
        $this->away_temperature_high_f   = isset($data->away_temperature_high_f) ? intval($data->away_temperature_high_f) : null;
        $this->away_temperature_high_c   = isset($data->away_temperature_high_c) ? floatval($data->away_temperature_high_c) : null;
        $this->away_temperature_low_f    = isset($data->away_temperature_low_f) ? intval($data->away_temperature_low_f) : null;
        $this->away_temperature_low_c    = isset($data->away_temperature_low_c) ? floatval($data->away_temperature_low_c) : null;
        $this->hvac_mode                 = isset($data->hvac_mode) ? $data->hvac_mode : null;
        $this->ambient_temperature_f     = isset($data->ambient_temperature_f) ? intval($data->ambient_temperature_f) : null;
        $this->ambient_temperature_c     = isset($data->ambient_temperature_c) ? floatval($data->ambient_temperature_c) : null;
        $this->humidity                  = isset($data->humidity) ? intval($data->humidity) : null;

    }

    /**
     *
     */
    public function toArray()
    {
        return [
            'device_id'                 => $this->device_id,
            'locale'                    => $this->locale,
            'software_version'          => $this->software_version,
            'structure_id'              => $this->structure_id,
            'name'                      => $this->name,
            'name_long'                 => $this->name_long,
            'last_connection'           => $this->last_connection,
            'is_online'                 => $this->is_online,
            'can_cool'                  => $this->can_cool,
            'can_heat'                  => $this->can_heat,
            'is_using_emergency_heat'   => $this->is_using_emergency_heat,
            'has_fan'                   => $this->has_fan,
            'fan_timer_active'          => $this->fan_timer_active,
            'fan_timer_timeout'         => $this->fan_timer_timeout,
            'has_leaf'                  => $this->has_leaf,
            'temperature_scale'         => $this->temperature_scale,
            'target_temperature_f'      => $this->target_temperature_f,
            'target_temperature_c'      => $this->target_temperature_c,
            'target_temperature_high_f' => $this->target_temperature_high_f,
            'target_temperature_high_c' => $this->target_temperature_high_c,
            'target_temperature_low_f'  => $this->target_temperature_low_f,
            'target_temperature_low_c'  => $this->target_temperature_low_c,
            'away_temperature_high_f'   => $this->away_temperature_high_f,
            'away_temperature_high_c'   => $this->away_temperature_high_c,
            'away_temperature_low_f'    => $this->away_temperature_low_f,
            'away_temperature_low_c'    => $this->away_temperature_low_c,
            'hvac_mode'                 => $this->hvac_mode,
            'ambient_temperature_f'     => $this->ambient_temperature_f,
            'ambient_temperature_c'     => $this->ambient_temperature_c,
            'humidity'                  => $this->humidity,
        ];
    }

}