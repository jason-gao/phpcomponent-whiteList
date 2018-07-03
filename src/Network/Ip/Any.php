<?php
/**
 * IP range converter for a any address
 *
 */

namespace WhiteList\Network\Ip;

/**
 * IP range converter for a any address
 *
 */
class Any implements Converter
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
        return $address === '*';
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
        return [
            (float)sprintf('%u', ip2long('0.0.0.0')),
            (float)sprintf('%u', ip2long('255.255.255.255')),
        ];
    }
}
