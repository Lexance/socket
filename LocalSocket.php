<?php

/*
 * This file is part of the BUNDLE.
 * 
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */
 

namespace lx\Socket;


use lx\Socket\Exception\IOException;
use lx\Socket\File\AbstractSocketFile;
use lx\Socket\File\LocalSocketFileInterface;

class LocalSocket extends AbstractSocket
{
    /**
     * {@inheritdoc}
     */
    public function __construct($file, $mode = self::DEFAULT_MODE, $timeout = self::DEFAULT_TIMEOUT)
    {
        if(!($file instanceof LocalSocketFileInterface))
            throw new \InvalidArgumentException(\sprintf('The given socket file %s does not implement lx\Socket\File\LocalSocketFileInterface.', $file));

        parent::__construct($file, $mode, $timeout);

        try {
            $handle = \fopen($file, $mode);
        } catch (\Exception $e) {
            throw new IOException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        if($handle === false)
            throw new IOException(\sprintf('Could not open %s with mode "%s".', $file, $mode));
        $this->handle = $handle;
    }

    /**
     * {@inheritdoc}
     */
    public static function applicable()
    {
        return 'local_socket';
    }
}