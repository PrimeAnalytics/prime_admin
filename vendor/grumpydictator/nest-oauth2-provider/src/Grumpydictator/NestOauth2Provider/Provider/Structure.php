<?php

namespace Grumpydictator\NestOauth2Provider\Provider;

/**
 * Class Structure
 *
 * @package Grumpydictator\NestOauth2Provider\Provider
 */
class Structure
{
    public $structure_id;
    public $thermostats     = [];
    public $smoke_co_alarms = [];
    public $away;
    public $name;
    public $country_code;
    public $postal_code;
    public $peak_period_start_time;
    public $peak_period_end_time;
    public $time_zone;

    /**
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        $this->structure_id           = isset($data->structure_id) ? $data->structure_id : null;
        $this->away                   = isset($data->away) ? $data->away : null;
        $this->name                   = isset($data->name) ? $data->name : null;
        $this->country_code           = isset($data->country_code) ? $data->country_code : null;
        $this->postal_code            = isset($data->postal_code) ? $data->postal_code : null;
        $this->time_zone              = isset($data->time_zone) ? new \DateTimeZone($data->time_zone) : null;
        $this->peak_period_start_time = isset($data->peak_period_start_time) ? new \DateTime($data->peak_period_start_time, $this->time_zone) : null;
        $this->peak_period_end_time   = isset($data->peak_period_end_time) ? new \DateTime($data->peak_period_end_time, $this->time_zone) : null;
    }

    /**
     * @return array
     */
    public function getThermostats()
    {
        return $this->thermostats;
    }

    /**
     * @return array
     */
    public function getSmokeCoAlarms()
    {
        return $this->smoke_co_alarms;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $arr = [
            'structure_id'           => $this->structure_id,
            'away'                   => $this->away,
            'name'                   => $this->name,
            'country_code'           => $this->country_code,
            'postal_code'            => $this->postal_code,
            'peak_period_start_time' => $this->peak_period_start_time,
            'peak_period_end_time'   => $this->peak_period_end_time,
            'time_zone'              => $this->time_zone,
            'thermostats'            => [],
            'smoke_co_alarms'        => [],
        ];

        /**
         * @var string     $identifier
         * @var Thermostat $thermostat
         */
        foreach ($this->thermostats as $identifier => $thermostat) {
            $arr['thermostats'][$identifier] = $thermostat->toArray();
        }
        /**
         * @var string       $identifier
         * @var SmokeCoAlarm $smokeCoAlarm
         */
        foreach ($this->smoke_co_alarms as $identifier => $smokeCoAlarm) {
            $arr['smoke_co_alarms'][$identifier] = $smokeCoAlarm->toArray();
        }

        return $arr;
    }

    /**
     * @param string     $identifier
     * @param Thermostat $thermostat
     */
    public function addThermostat($identifier, Thermostat $thermostat)
    {
        $this->thermostats[$identifier] = $thermostat;

    }

    /**
     * @param string       $identifier
     * @param SmokeCoAlarm $alarm
     */
    public function addSmokeCoAlarm($identifier, SmokeCoAlarm $alarm)
    {
        $this->smoke_co_alarms[$identifier] = $alarm;
    }


}