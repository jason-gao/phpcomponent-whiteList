<?php
/**
 * IP range converter for a CIDR IP address
 *
 */

namespace WhiteList\Network\Ip;

/**
 * IP range converter for a CIDR IP address
 *
 */
class Cidr implements Converter
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
        return !!preg_match('/^\d+\.\d+\.\d+\.\d+\/\d+$/', $address);
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
        $cidr = explode('/', $address);

        return [
            (float)sprintf('%u', (ip2long($cidr[0])) & ((-1 << (32 - (int)$cidr[1])))),
            (float)sprintf('%u', (ip2long($cidr[0])) + pow(2, (32 - (int)$cidr[1])) - 1),
        ];
    }
}
