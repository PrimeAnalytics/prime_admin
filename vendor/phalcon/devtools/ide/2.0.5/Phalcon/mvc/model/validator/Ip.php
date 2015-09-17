<?php

namespace Phalcon\Mvc\Model\Validator;

/**
 * Phalcon\Mvc\Model\Validator\IP
 * Validates that a value is ipv4 address in valid range
 * <code>
 * use Phalcon\Mvc\Model\Validator\CardNumber;
 * class Data extends Phalcon\Mvc\Model
 * {
 * public function validation()
 * {
 * // Any pubic IP
 * $this->validate(new IPv4(array(
 * 'field'             => 'server_ip',
 * 'version'           => IP::VERSION_4 | IP::VERSION_6, // v6 and v4. The same if not specified
 * 'allowReserved'     => false,   // False if not specified. Ignored for v6
 * 'allowPrivate'      => false,   // False if not specified
 * 'message'           => 'IP address has to be correct'
 * )));
 * // Any public v4 address
 * $this->validate(new IP(array(
 * 'field'             => 'ip_4',
 * 'version'           => IP::VERSION_4,
 * 'message'           => 'IP address has to be correct'
 * )));
 * // Any v6 address
 * $this->validate(new IP(array(
 * 'field'             => 'ip6',
 * 'version'           => IP::VERSION_6,
 * 'allowPrivate'      => true,
 * 'message'           => 'IP address has to be correct'
 * )));
 * if ($this->validationHasFailed() == true) {
 * return false;
 * }
 * }
 * }
 * </code>
 */
class Ip extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
{

    const VERSION_4 = 1048576;


    const VERSION_6 = 2097152;


    /**
     * Executes the validator
     *
     * @param mixed $record 
     * @return bool 
     */
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}


     function zephir_init_properties_Phalcon_Mvc_Model_Validator_Ip() {}

}
