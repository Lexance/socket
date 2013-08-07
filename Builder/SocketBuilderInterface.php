<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\Builder;

use lx\Socket\File\AbstractSocketFile;

interface SocketBuilderInterface
{
    /**
     * @param string $file
     * @param string $mode
     * @param string $timeout
     *
     * @return mixed
     */
    public function build($file, $mode = AbstractSocketFile::DEFAULT_MODE, $timeout = AbstractSocket::DEFAULT_TIMEOUT);

    /**
     * @param string $type
     * @param string $class
     * @return $this
     */
    public function addSocketClass($type, $class);

    /**
     * @param string $type
     * @return $this
     */
    public function removeSocketClass($type);
}