<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\File;

use lx\Socket\Connection\RemoteSocketConnectionInterface;

interface RemoteSocketFileInterface
{
    /**
     * @param RemoteSocketConnectionInterface|null $connection
     * @return $this
     */
    public function setConnection(RemoteSocketConnectionInterface $connection = null);

    /**
     * @return RemoteSocketConnectionInterface|null
     */
    public function getConnection();

    /**
     * @return bool
     */
    public function hasConnection();
}