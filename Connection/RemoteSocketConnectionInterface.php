<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\Connection;

interface RemoteSocketConnectionInterface
{
    /**
     * @param string $host
     * @param int    $port
     * @param array  $parameters
     */
    public function __construct($host, $port, array $parameters = array());

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return int
     */
    public function getPort();

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @return string
     */
    public function __toString();
}