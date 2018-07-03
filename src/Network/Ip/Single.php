<?php
/**
 * IP range converter for a single IP address
 *
 */

namespace WhiteList\Network\Ip;

/**
 * IP range converter for a single IP address
 *
 */
class Single implements Converter
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
        return !!filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
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
            (float)sprintf('%u', ip2long($address)),
            (float)sprintf('%u', ip2long($address)),
        ];
    }
}
