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
     * @param AbstractSocketFile $file
     * @return string
     */
    public function build($file);

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