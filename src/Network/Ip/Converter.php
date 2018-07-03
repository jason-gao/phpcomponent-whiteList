<?php
/**
 * Interface for IP (range) converters
 *
 */

namespace WhiteList\Network\Ip;

/**
 * Interface for IP (range) converters
 *
 */
interface Converter
{
    /**
     * Checks whether is certain address is valid for the converter implementation
     *
     * @param string $address The address to check
     *
     * @return boolean True when the address is valid
     */
    public function isValid($address);

    /**
     * Converts an IP address or range into a range to easily check for access
     *
     * @param string $address The IP address / range
     *
     * @return double[] Array containing the first and last ip in the range
     */
    public function convert($address);
}
