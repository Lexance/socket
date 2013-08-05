<?php

/*
 * This file is part of the lxSocket libary.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\File;

abstract class AbstractSocketFile extends \SplFileInfo
{
    /**
     * @var string
     */
    protected $file_name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param $file_name
     */
    public function __construct($file_name, $type)
    {
        parent::__construct($file_name);
        $this->file_name = $file_name;
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return \file_exists($this->file_name);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}