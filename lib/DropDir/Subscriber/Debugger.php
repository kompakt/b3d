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
use Kompakt\B3d\DropDir\Event\FileErrorEvent;
use Kompakt\B3d\DropDir\Event\FileEvent;
use Kompakt\B3d\DropDir\Event\EndErrorEvent;
use Kompakt\B3d\DropDir\Event\EndEvent;
use Kompakt\B3d\DropDir\Event\RunErrorEvent;
use Kompakt\B3d\DropDir\Event\RunEvent;

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
            $this->eventNames->run() => array(
                array('onRun', 0)
            ),
            $this->eventNames->runError() => array(
                array('onRunError', 0)
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

    public function onRun(RunEvent $event)
    {
        $this->writeln(
            sprintf(
                '+ DEBUG: Run'
            )
        );
    }

    public function onRunError(RunErrorEvent $event)
    {
        $this->writeln(
            sprintf(
                '+ DEBUG: Run error %s',
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