<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir;

use Kompakt\B3d\DropDir\EventNamesInterface;

class EventNames implements EventNamesInterface
{
    protected $namespace = null;

    public function __construct($namespace = 'drop_dir')
    {
        $this->namespace = $namespace;
    }

    public function start()
    {
        return sprintf('%s.start', $this->namespace);
    }

    public function startError()
    {
        return sprintf('%s.start_error', $this->namespace);
    }

    public function end()
    {
        return sprintf('%s.end', $this->namespace);
    }

    public function endError()
    {
        return sprintf('%s.end_error', $this->namespace);
    }

    public function file()
    {
        return sprintf('%s.file', $this->namespace);
    }

    public function fileError()
    {
        return sprintf('%s.file_error', $this->namespace);
    }
}