<?php
/**
 * IP range converter for a localhost loopback address
 */

namespace WhiteList\Network\Ip;

/**
 * IP range converter for a localhost loopback address
 *
 */
class Localhost extends Single
{
    /**
     * Checks whether is certain address is valid for the converter implementation
     *
     * @param string $address The address to check
     *
     * @return boolean True when the address is valid
     */
    public function isValid($address)
    {
        return $address === 'localhost';
    }

    /**
     * Converts an IP address or range into a range to easily check for access
     *
     * @param string $address The IP address / range
     *
     * @return double[] Array containing the first and last ip in the range
     */
    public function convert($address)
    {
        return parent::convert('127.0.0.1');
    }
}
