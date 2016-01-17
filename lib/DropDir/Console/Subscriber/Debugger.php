<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir\Console\Subscriber;

use Kompakt\B3d\Generic\Console\Output\ConsoleOutputInterface;
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
    protected $output = null;

    public function __construct(
        EventNamesInterface $eventNames,
        ConsoleOutputInterface $output
    )
    {
        $this->eventNames = $eventNames;
        $this->output = $output;
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
        $this->output->writeln(
            sprintf(
                '<info>+ DEBUG: Start</info>'
            )
        );
    }

    public function onStartError(StartErrorEvent $event)
    {
        $this->output->writeln(
            sprintf(
                '<error>+ DEBUG: Start error %s</error>',
                $event->getException()->getMessage()
            )
        );
    }

    public function onEnd(EndEvent $event)
    {
        $this->output->writeln(
            sprintf(
                '<info>+ DEBUG: End</info>'
            )
        );
    }

    public function onEndError(EndErrorEvent $event)
    {
        $this->output->writeln(
            sprintf(
                '<error>+ DEBUG: End error %s</error>',
                $event->getException()->getMessage()
            )
        );
    }

    public function onFile(FileEvent $event)
    {
        $this->output->writeln(
            sprintf(
                '  <info>+ DEBUG: File (%s)</info>',
                $event->getFile()
            )
        );
    }

    public function onFileError(FileErrorEvent $event)
    {
        $this->output->writeln(
            sprintf(
                '  <error>! DEBUG: File error (%s): %s</error>',
                $event->getFile(),
                $event->getException()->getMessage()
            )
        );
    }
}