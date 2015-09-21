<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir\Event;

use Kompakt\B3d\Generic\EventDispatcher\Event;

class RunErrorEvent extends Event
{
    protected $exception = null;
    protected $dir = null;

    public function __construct(\Exception $exception, \DirectoryIterator $dir)
    {
        $this->exception = $exception;
        $this->dir = $dir;
    }

    public function getException()
    {
        return $this->exception;
    }

    public function getDir()
    {
        return $this->dir;
    }
}