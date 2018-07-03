<?php
/**
 * Handles IP whitelisting
 *
 */

namespace WhiteList\Auth;

/**
 * Handles IP whitelisting
 *
 */
class Ip implements Whitelist
{
    /**
     *  List of address to range converters
     */
    private $converters = [];

    /**
     * @var array List of whitelist ranges
     */
    private $whitelists = [];

    /**
     * Creates instance
     *
     * @param  array $converters List of address to range converters
     */
    public function __construct(array $converters)
    {
        $this->converters = $converters;
    }

    /**
     * Builds the whitelist
     *
     * @param array $addresses List of addresses which form the whitelist
     */
    public function buildWhitelist(array $addresses)
    {
        foreach ($addresses as $address) {
            $this->addWhitelist($address);
        }
    }

    /**
     * Adds a range to the whitelist
     *
     * @param string $address The address(range) to add to the whitelist
     */
    private function addWhitelist($address)
    {
        foreach ($this->converters as $converter) {
            if (!$converter->isValid($address)) {
                continue;
            }

            $this->whitelists[] = $converter->convert($address);
        }
    }

    /**
     * Checks whether the ip is allowed access
     *
     * @param string $ip The IP address to check
     *
     * @return boolean True when the IP is allowed access
     */
    public function isAllowed($ip)
    {
        $ip = (float)sprintf('%u', ip2long($ip));

        foreach ($this->whitelists as $whitelist) {
            if ($ip >= $whitelist[0] && $ip <= $whitelist[1]) {
                return true;
            }
        }

        return false;
    }
}
