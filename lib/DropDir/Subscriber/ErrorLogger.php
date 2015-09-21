<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir\Subscriber;

use Kompakt\B3d\Generic\EventDispatcher\EventSubscriberInterface;
use Kompakt\B3d\Generic\Logger\Handler\StreamHandlerFactoryInterface;
use Kompakt\B3d\Generic\Logger\LoggerInterface;
use Kompakt\B3d\DropDir\EventNamesInterface;
use Kompakt\B3d\DropDir\Event\FileErrorEvent;
use Kompakt\B3d\DropDir\Event\EndErrorEvent;
use Kompakt\B3d\DropDir\Event\RunErrorEvent;
use Kompakt\B3d\DropDir\Event\RunEvent;

class ErrorLogger implements EventSubscriberInterface
{
    protected $eventNames = null;
    protected $logger = null;
    protected $streamHandlerFactory = null;

    public function __construct(
        EventNamesInterface $eventNames,
        LoggerInterface $logger,
        StreamHandlerFactoryInterface $streamHandlerFactory,
        $filename
    )
    {
        $this->eventNames = $eventNames;
        $this->logger = $logger;
        $this->streamHandlerFactory = $streamHandlerFactory;
        $this->filename = $filename;
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
            $this->eventNames->endError() => array(
                array('onEndError', 0)
            ),
            $this->eventNames->fileError() => array(
                array('onFileError', 0)
            )
        );
    }

    public function onRun(RunEvent $event)
    {
        $logfile = sprintf('%s/%s', $event->getDir(), $this->filename);
        $this->logger->pushHandler($this->streamHandlerFactory->getInstance($logfile));
    }

    public function onRunError(RunErrorEvent $event)
    {
        $this->logger->error($event->getException()->getMessage());
    }

    public function onEndError(EndErrorEvent $event)
    {
        $this->logger->error($event->getException()->getMessage());
    }

    public function onFileError(FileErrorEvent $event)
    {
        $this->logger->error(
            sprintf(
                '%s: "%s"',
                $event->getFile()->getPathname(),
                $event->getException()->getMessage()
            )
        );
    }
}