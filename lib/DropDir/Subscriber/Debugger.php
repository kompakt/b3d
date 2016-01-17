<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir\Subscriber;

use Kompakt\B3d\Generic\EventDispatcher\EventSubscriberInterface;
use Kompakt\B3d\DropDir\EventNamesInterface;
use Kompakt\B3d\DropDir\Event\EndErrorEvent;
use Kompakt\B3d\DropDir\Event\EndEvent;
use Kompakt\B3d\DropDir\Event\FileErrorEvent;
use Kompakt\B3d\DropDir\Event\FileEvent;
use Kompakt\B3d\DropDir\Event\StartErrorEvent;
use Kompakt\B3d\DropDir\Event\StartEvent;

class Debugger implements EventSubscriberInterface
{
    protected $eventNames = null;

    public function __construct(
        EventNamesInterface $eventNames
    )
    {
        $this->eventNames = $eventNames;
    }

    public function getSubscriptions()
    {
        return array(
            $this->eventNames->start() => array(
                array('onStart', 0)
            ),
            $this->eventNames->startError() => array(
                array('onStartError', 0)
            ),
            $this->eventNames->end() => array(
                array('onEnd', 0)
            ),
            $this->eventNames->endError() => array(
                array('onEndError', 0)
            ),
            $this->eventNames->file() => array(
                array('onFile', 0)
            ),
            $this->eventNames->fileError() => array(
                array('onFileError', 0)
            )
        );
    }

    public function onStart(StartEvent $event)
    {
        $this->writeln(
            sprintf(
                '+ DEBUG: Start'
            )
        );
    }

    public function onStartError(StartErrorEvent $event)
    {
        $this->writeln(
            sprintf(
                '+ DEBUG: Start error %s',
                $event->getException()->getMessage()
            )
        );
    }

    public function onEnd(EndEvent $event)
    {
        $this->writeln(
            sprintf(
                '+ DEBUG: End'
            )
        );
    }

    public function onEndError(EndErrorEvent $event)
    {
        $this->writeln(
            sprintf(
                '+ DEBUG: End error %s',
                $event->getException()->getMessage()
            )
        );
    }

    public function onFile(FileEvent $event)
    {
        $this->writeln(
            sprintf(
                '  + DEBUG: File (%s)',
                $event->getFile()->getPathname()
            )
        );
    }

    public function onFileError(FileErrorEvent $event)
    {
        $this->writeln(
            sprintf(
                '  ! DEBUG: File error (%s): %s',
                $event->getFile(),
                $event->getException()->getMessage()
            )
        );
    }

    protected function writeln($msg)
    {
        echo sprintf("%s\n", $msg);
    }
}