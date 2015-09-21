<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir;

use Kompakt\B3d\DropDir\EventNamesInterface;
use Kompakt\B3d\DropDir\Event\FileErrorEvent;
use Kompakt\B3d\DropDir\Event\FileEvent;
use Kompakt\B3d\DropDir\Event\EndErrorEvent;
use Kompakt\B3d\DropDir\Event\EndEvent;
use Kompakt\B3d\DropDir\Event\RunErrorEvent;
use Kompakt\B3d\DropDir\Event\RunEvent;
use Kompakt\B3d\DropDir\Exception\RuntimeException;
use Kompakt\B3d\Generic\EventDispatcher\EventDispatcherInterface;

class DropDir
{
    protected $dispatcher = null;
    protected $eventNames = null;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        EventNamesInterface $eventNames
    )
    {
        $this->dispatcher = $dispatcher;
        $this->eventNames = $eventNames;
    }

    public function open(\DirectoryIterator $dir)
    {
        try {
            if (!$this->run($dir))
            {
                $this->end($dir);
                return;
            }

            foreach ($dir as $fileInfo)
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

            $this->end($dir);
        }
        catch (\Exception $e)
        {
            throw new RuntimeException(sprintf('Dir runner error'), null, $e);
        }
    }

    protected function run($dir)
    {
        try {
            $this->dispatcher->dispatch(
                $this->eventNames->run(),
                new RunEvent($dir)
            );

            return true;
        }
        catch (\Exception $e)
        {
            $this->dispatcher->dispatch(
                $this->eventNames->runError(),
                new RunErrorEvent($e, $dir)
            );

            return false;
        }
    }

    protected function end($dir)
    {
        try {
            $this->dispatcher->dispatch(
                $this->eventNames->end(),
                new EndEvent($dir)
            );

            return true;
        }
        catch (\Exception $e)
        {
            $this->dispatcher->dispatch(
                $this->eventNames->endError(),
                new EndErrorEvent($e, $dir)
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