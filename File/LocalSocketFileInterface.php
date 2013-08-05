<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\File;

interface LocalSocketFileInterface
{
    /**
     * @return RemoteSocketFileInterface|null
     */
    public function getRemoteFile();

    /**
     * @param RemoteSocketFileInterface|null $file
     * @return $this
     */
    public function setRemoteFile(RemoteSocketFileInterface $remote_file = null);

    /**
     * @return bool
     */
    public function hasRemoteFile();
}