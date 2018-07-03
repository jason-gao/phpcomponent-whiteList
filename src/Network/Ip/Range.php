<?php
/**
 * IP range converter for a range
 *
 * E.g. 10.0.0.1-10.0.1.100
 *
 */

namespace WhiteList\Network\Ip;

/**
 * IP range converter for a range
 *
 */
class Range implements Converter
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
        return !!preg_match('/^\d+\.\d+\.\d+\.\d+\s?-\s?\d+\.\d+\.\d+\.\d+$/', $address);
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
        $parts = explode('-', $address);

        return [
            (float)sprintf('%u', ip2long(trim($parts[0]))),
            (float)sprintf('%u', ip2long(trim($parts[1]))),
        ];
    }
}
