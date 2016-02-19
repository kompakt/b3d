<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir\Event;

use Symfony\Component\EventDispatcher\Event;

class EndEvent extends Event
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