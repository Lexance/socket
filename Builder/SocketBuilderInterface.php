<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\Builder;

use lx\Socket\AbstractSocket;
use lx\Socket\File\AbstractSocketFile;

interface SocketBuilderInterface
{
    /**
     * @param AbstractSocketFile $file
     * @param string             $mode
     * @param string             $timeout
     *
     * @return AbstractSocket
     */
    public function build(AbstractSocketFile $file, $mode = AbstractSocket::DEFAULT_MODE, $timeout = AbstractSocket::DEFAULT_TIMEOUT);

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