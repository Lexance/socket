<?php

/*
 * This file is part of the lxSocket libary.
 * 
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\Builder;

use lx\Socket\AbstractSocket;
use lx\Socket\File\AbstractSocketFile;

class SocketBuilder implements SocketBuilderInterface
{
    /**
     * @var string[]
     */
    protected $socket_classes;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->socket_classes = array();
    }

    /**
     * {@inheritdoc}
     * @throws \LogicException
     */
    public function build(AbstractSocketFile $file, $mode = AbstractSocket::DEFAULT_MODE, $timeout = AbstractSocket::DEFAULT_TIMEOUT)
    {
        if(!isset($this->socket_classes[$file->getType()]))
            throw new \LogicException(\sprintf('The file "%s" had the type "%s" but the builder had no socket class for that type. Available types are: %s', $file, $file->getType(), \implode(', '. \array_keys($this->socket_classes))));
        $class = $this->socket_classes[$file->getType()];
        return new $class($file, $mode, $timeout);
    }

    /**
     * {@inheritdoc}
     * @throws \LogicException
     */
    public function addSocketClass($type, $class)
    {
        if(!\class_exists($class))
            throw new \LogicException(\sprintf('The class "%s" could not be found.', $class));

        if(isset($this->socket_classes[$type]))
            throw new \LogicException(\sprintf('There is already a socket class for the socket type "%s".', $type));
        if(!\class_exists($class))
            throw new \LogicException(\sprintf('Socket class "%s" as specified for the socket type "%s" could not be found.', $class, $type));

        $this->socket_classes[$type] = $class;

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \LogicException
     */
    public function removeSocketClass($type)
    {
        if(!isset($this->socket_classes[$type]))
            throw new \LogicException(\sprintf('There is no socket class for the socket type "%s".', $type));

        unset($this->socket_classes[$type]);

        return $this;
    }
}