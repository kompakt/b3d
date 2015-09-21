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
use Kompakt\B3d\DropDir\Event\FileErrorEvent;
use Kompakt\B3d\DropDir\Event\FileEvent;
use Kompakt\B3d\DropDir\Event\EndErrorEvent;
use Kompakt\B3d\DropDir\Event\EndEvent;
use Kompakt\B3d\DropDir\Event\RunErrorEvent;
use Kompakt\B3d\DropDir\Event\RunEvent;

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
        $this->output->writeln(
            sprintf(
                '<info>+ DEBUG: Run</info>'
            )
        );
    }

    public function onRunError(RunErrorEvent $event)
    {
        $this->output->writeln(
            sprintf(
                '<error>+ DEBUG: Run error %s</error>',
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