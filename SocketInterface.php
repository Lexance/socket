<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket;

use lx\Socket\File\AbstractSocketFile;

interface SocketInterface
{
    const DEFAULT_TIMEOUT = 2000000;
    const DEFAULT_LENGTH  = 128;
    const DEFAULT_MODE    = 'r';

    /**
     * @param AbstractSocketFile $file
     * @param string             $mode
     * @param int                $timeout Time for timeout
     *
     * @return mixed
     */
    public function __construct($file, $mode = self::DEFAULT_MODE, $timeout = self::DEFAULT_TIMEOUT);

    /**
     * @return string
     */
    public static function applicable();

    /**
     * Writing to a socket with the standard fwrite may not write all bytes at the first time. Similar to the
     * Linux(<3) write() system function we have to try it again.
     *
     * @param string $data
     *
     * @return int
     */
    public function write($data);

    /**
     * @param int $length
     *
     * @return string
     */
    public function readLine($length = self::DEFAULT_LENGTH);

    /**
     * @param int $length
     *
     * @return string
     */
    public function read($length = self::DEFAULT_LENGTH);

    /**
     * @return bool
     * @throws \LogicException
     */
    public function isEof();
    /**
     * @param int $offset
     * @param int $whence
     *
     * @return int
     */
    public function seek($offset, $whence = SEEK_SET);

    /**
     * @return bool
     * @throws \LogicException
     */
    public function close();

    /**
     * @return $this
     */
    public function resetWriteSize();

    /**
     * @return int
     */
    public function getWriteSize();

    /**
     * @return $this
     */
    public function resetReadSize();

    /**
     * @return int
     */
    public function getReadSize();
}