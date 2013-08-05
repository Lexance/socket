<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\File;

use lx\Socket\Connection\SocketConnectionInterface;

class RemoteSocketFile extends AbstractSocketFile implements RemoteSocketFileInterface
{
    /**
     * @var SocketConnectionInterface|null
     */
    protected $connection;

    /**
     * {@inheritdoc}
     */
    public function setConnection(SocketConnectionInterface $connection = null)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * {@inheritdoc}
     */
    public function hasConnection()
    {
        return ($this->connection === null ? false : true);
    }
}