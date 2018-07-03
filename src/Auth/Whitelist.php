<?php
/**
 * Interface for handling IP whitelisting
 *
 */

namespace WhiteList\Auth;

/**
 * Interface for handling IP whitelisting
 *
 */
interface Whitelist
{
    /**
     * Builds the whitelist
     *
     * @param array $addresses List of addresses which form the whitelist
     *
     * @return void
     */
    public function buildWhitelist(array $addresses);

    /**
     * Checks whether the ip is allowed access
     *
     * @param string $ip The IP address to check
     *
     * @return boolean True when the IP is allowed access
     */
    public function isAllowed($ip);
}
