<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket;

use lx\Socket\Exception\IOException;
use lx\Socket\File\AbstractSocketFile;

abstract class AbstractSocket implements SocketInterface
{
    /**
     * @var AbstractSocketFile
     */
    protected $file;

    /**
     * @var resource
     */
    protected $handle;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var array|null
     */
    protected $meta_data;

    /**
     * @var int|null
     */
    protected $eof_time;

    /**
     * @var int
     */
    protected $read_size;

    /**
     * @var int
     */
    protected $write_size;

    /**
     * {@inheritdoc}
     */
    public function __construct($file, $mode = self::DEFAULT_MODE, $timeout = self::DEFAULT_TIMEOUT)
    {
        $this->file =    $file;
        $this->timeout = (int)$timeout;
        $this->mode =    $mode;
        $this->resetReadSize();
        $this->resetWriteSize();
    }

    /**
     * {@inheritdoc}
     * @throws IOException
     */
    public function write($data)
    {
        $bytes_to_write = \strlen($data);
        $bytes_written  = 0;

        while ($bytes_written < $bytes_to_write) {
            $returnval = ($bytes_written == 0 ? \fwrite($this->handle, $data) : \fwrite($this->handle, \substr($data, $bytes_written)));

            if ($returnval === false || $returnval == 0) {
                if ($bytes_written === 0) {
                    throw new IOException('Could not write into socket for file "%s".', $this->file->getPathname());
                } else {
                    $this->write_size += $bytes_written;

                    return $bytes_written;
                }
            }
            $bytes_written += $returnval;
        }
        $this->write_size += $bytes_written;

        return $bytes_written;
    }

    /**
     * {@inheritdoc}
     */
    public function readLine($length = self::DEFAULT_LENGTH)
    {
        $data = \fgets($this->handle, $length);

        return $this->baseRead($data, $length);
    }

    /**
     * {@inheritdoc}
     */
    public function read($length = self::DEFAULT_LENGTH)
    {
        $data = \fread($this->handle, $length);

        return $this->baseRead($data, $length);
    }

    /**
     * {@inheritdoc}
     * @throws IOException
     */
    protected function baseRead($data, $length)
    {
        $this->read_size += $length;
        $this->meta_data = \stream_get_meta_data($this->handle);
        // if the result is a string leave metadata checks byside
        if (\is_string($data) === true)
            return $data;

        if ($this->meta_data['timed_out'] === true)
            throw new IOException(\sprintf('Socket for file "%s" timed out.', $this->file->getPathname()));
        if ($this->meta_data['blocked'] === true)
            throw new IOException(\sprintf('Socket for file "%s" blocked.', $this->file->getPathname()));
        if ($data === false)
            throw new IOException(\sprintf('Failed to read file "%s".', $this->file->getPathname()));
    }

    /**
     * {@inheritdoc}
     * @throws \LogicException
     */
    public function isEof()
    {
        $this->eof_time = \microtime(true);

        return (\feof($this->handle) && (microtime(true) - $this->eof_time) < $this->timeout);
    }

    /**
     * {@inheritdoc}
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        try {
            \fseek($this->handle, $offset, $whence);
        } catch (\Exception $e) {
            throw new IOException('The socket does not support seeking.');
        }
    }

    /**
     * {@inheritdoc}
     * @throws \LogicException
     * @throws IOException
     */
    public function close()
    {
        if (\is_resource($this->handle) === false)
            throw new \LogicException(\sprintf('Failed to close socket for file "%s". Handle is no resource.', $this->file->getPathname()));
        if (\fclose($this->handle) === false)
            throw new IOException(\sprintf('Failed to close handle for file %s', $this->file->getPathname()));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function resetWriteSize()
    {
        $this->write_size = 0;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWriteSize()
    {
        return $this->write_size;
    }

    /**
     * {@inheritdoc}
     */
    public function resetReadSize()
    {
        $this->read_size = 0;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReadSize()
    {
        return $this->read_size;
    }
}