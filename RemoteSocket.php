<?php

/*
 * This file is part of the BUNDLE.
 * 
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */
 

namespace lx\Socket;

use lx\Socket\Connection\SocketConnectionInterface;
use lx\Socket\Exception\IOException;
use lx\Socket\File\RemoteSocketFileInterface;

class RemoteSocket extends AbstractSocket
{
    /**
     * {@inheritdoc}
     */
    public function __construct($file, $mode = self::DEFAULT_MODE, $timeout = self::DEFAULT_TIMEOUT)
    {
        if(!($file instanceof RemoteSocketFileInterface))
            throw new \InvalidArgumentException(\sprintf('The given socket file %s does not implement lx\Socket\File\RemoteSocketFileInterface.', $file));

        parent::__construct($file, $mode, $timeout);

        /** @var SocketConnectionInterface $connection */
        $connection = $file->getConnection();
        $errorno = 0;
        $errorstr = '';
        try {
            $handle = \fsockopen($connection->getHost(), $connection->getPort(), $errorno, $errorstr, $timeout);
            if($handle == false)
                throw new IOException($errorstr, $errorno);
            $timeout = \stream_set_timeout($handle, $timeout);
            if($timeout == false)
                throw new IOException(\sprintf('Error while setting timeout for stream for host "%s".', $connection->getHost(), $timeout));
        } catch (\Exception $e) {
            throw new IOException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
        $this->handle = $handle;
    }

    /**
     * {@inheritdoc}
     */
    public static function applicable()
    {
        return 'remote_socket';
    }
}