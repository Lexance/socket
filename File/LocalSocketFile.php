<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\File;

class LocalSocketFile extends AbstractSocketFile implements LocalSocketFileInterface
{
    /**
     * @var RemoteSocketFileInterface|null
     */
    protected $remote_file;

    /**
     * @return RemoteSocketFileInterface|null
     */
    public function getRemoteFile()
    {
        return $this->remote_file;
    }

    /**
     * @param RemoteSocketFileInterface|null $file
     * @return $this
     */
    public function setRemoteFile(RemoteSocketFileInterface $remote_file = null)
    {
        $this->remote_file = $remote_file;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasRemoteFile()
    {
        return ($this->remote_file === null ? false : true);
    }
}