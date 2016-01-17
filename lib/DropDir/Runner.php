<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir;

use Kompakt\B3d\DropDir\EventNamesInterface;
use Kompakt\B3d\DropDir\Event\EndErrorEvent;
use Kompakt\B3d\DropDir\Event\EndEvent;
use Kompakt\B3d\DropDir\Event\FileErrorEvent;
use Kompakt\B3d\DropDir\Event\FileEvent;
use Kompakt\B3d\DropDir\Event\StartErrorEvent;
use Kompakt\B3d\DropDir\Event\StartEvent;
use Kompakt\B3d\DropDir\Exception\RuntimeException;
use Kompakt\B3d\Generic\EventDispatcher\EventDispatcherInterface;

class Runner
{
    protected $dispatcher = null;
    protected $eventNames = null;
    protected $dir = null;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        EventNamesInterface $eventNames,
        $dir
    )
    {
        $this->dispatcher = $dispatcher;
        $this->eventNames = $eventNames;
        $this->dir = new \DirectoryIterator($dir);
    }

    public function run()
    {
        try {
            if (!$this->start())
            {
                $this->end();
                return;
            }

            foreach ($this->dir as $fileInfo)
            {
                if ($fileInfo->isDot())
                {
                    continue;
                }

                if ($fileInfo->isDir())
                {
                    continue;
                }

                if (!$this->file($fileInfo))
                {
                    continue;
                }
            }

            $this->end();
        }
        catch (\Exception $e)
        {
            throw new RuntimeException(sprintf('Dir runner error'), null, $e);
        }
    }

    protected function start()
    {
        try {
            $this->dispatcher->dispatch(
                $this->eventNames->start(),
                new StartEvent($this->dir)
            );

            return true;
        }
        catch (\Exception $e)
        {
            $this->dispatcher->dispatch(
                $this->eventNames->startError(),
                new StartErrorEvent($e, $this->dir)
            );

            return false;
        }
    }

    protected function end()
    {
        try {
            $this->dispatcher->dispatch(
                $this->eventNames->end(),
                new EndEvent($this->dir)
            );

            return true;
        }
        catch (\Exception $e)
        {
            $this->dispatcher->dispatch(
                $this->eventNames->endError(),
                new EndErrorEvent($e, $this->dir)
            );

            return false;
        }
    }

    protected function file($file)
    {
        try {
            $this->dispatcher->dispatch(
                $this->eventNames->file(),
                new FileEvent($file)
            );

            return true;
        }
        catch (\Exception $e)
        {
            $this->dispatcher->dispatch(
                $this->eventNames->fileError(),
                new FileErrorEvent($e, $file)
            );

            return false;
        }
    }
}