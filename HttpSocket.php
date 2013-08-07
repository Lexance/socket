<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket;

use lx\Socket\Connection\HttpSocketConnection;
use lx\Socket\File\AbstractSocketFile;
use lx\Socket\File\RemoteSocketFileInterface;

class HttpSocket extends RemoteSocket
{
    /**
     * {@inheritdoc}
     */
    public function __construct($file, $mode = self::DEFAULT_MODE, $timeout = self::DEFAULT_TIMEOUT)
    {
        parent::__construct($file, $mode, $timeout);
        /** @var RemoteSocketFileInterface  $file */
        /** @var HttpSocketConnection $connection */
        $connection = $file->getConnection();
        if(!($connection instanceof HttpSocketConnection))
            throw new \InvalidArgumentException(\sprintf('The given socket connection of file %s does not implement lx\Socket\Connection\HttpSocketConnection.', $file));

        $this->write($this->generateRequestHeader());

        $header = '';
        do {
            $header .= $this->readLine();
            // \r\n\r\n common known for the end of a http header
        } while (\strpos($header, "\r\n\r\n") === false && $this->isEof() === false);

        $connection->setResponseHeader($header);
        $this
            ->resetReadSize()
            ->resetWriteSize();
    }

    /**
     * @return string
     */
    public function generateRequestHeader()
    {
        /** @var HttpSocketConnection $connection */
        $connection = $this->file->getConnection();
        $parameters = $connection->getParameters();
        /** @var AbstractSocketFile $file */
        $header = \sprintf("GET %s HTTP/1.1\r\nHost: %s\r\n%sConnection: Close\r\n\r\n",
            $this->file->getPathname(),
            $connection->getHost(),
            ($parameters['username'] !== false ? \sprintf("Authorization: Basic %s\r\n", \base64_encode($parameters['username'] . ':' . $parameters['password'])) : '')
        );
        $connection->setRequestHeader($header);

        return $header;
    }

    /**
     * {@inheritdoc}
     */
    public static function applicable()
    {
        return 'http_socket';
    }
}