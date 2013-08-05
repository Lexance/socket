<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\File;

use lx\Socket\Connection\SocketConnectionInterface;

interface RemoteSocketFileInterface
{
    /**
     * @param SocketConnectionInterface|null $connection
     * @return $this
     */
    public function setConnection(SocketConnectionInterface $connection = null);

    /**
     * @return SocketConnectionInterface|null
     */
    public function getConnection();

    /**
     * @return bool
     */
    public function hasConnection();
}