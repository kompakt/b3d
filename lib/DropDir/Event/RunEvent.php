<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir\Event;

use Kompakt\B3d\Generic\EventDispatcher\Event;

class RunEvent extends Event
{
    protected $dir = null;

    public function __construct(\DirectoryIterator $dir)
    {
        $this->dir = $dir;
    }

    public function getDir()
    {
        return $this->dir;
    }
}