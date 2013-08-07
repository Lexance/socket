<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\Connection;

class RemoteSocketConnection implements RemoteSocketConnectionInterface
{
    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var array
     */
    protected $type_parameters;

    /**
     * @param string $host
     * @param int    $port
     * @param array  $parameters
     */
    public function __construct($host, $port, array $parameters = array())
    {
        $this->host = $host;
        $this->port = $port;
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->type_parameters;
    }
}