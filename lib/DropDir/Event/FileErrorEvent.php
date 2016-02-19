<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir\Event;

use Symfony\Component\EventDispatcher\Event;

class FileErrorEvent extends Event
{
    protected $exception = null;
    protected $file = null;

    public function __construct(\Exception $exception, $file)
    {
        $this->exception = $exception;
        $this->file = $file;
    }

    public function getException()
    {
        return $this->exception;
    }

    public function getFile()
    {
        return $this->file;
    }
}