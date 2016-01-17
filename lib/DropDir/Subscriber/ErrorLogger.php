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
use Kompakt\B3d\DropDir\Event\EndErrorEvent;
use Kompakt\B3d\DropDir\Event\FileErrorEvent;
use Kompakt\B3d\DropDir\Event\StartErrorEvent;
use Kompakt\B3d\DropDir\Event\StartEvent;

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
            $this->eventNames->start() => array(
                array('onStart', 0)
            ),
            $this->eventNames->startError() => array(
                array('onStartError', 0)
            ),
            $this->eventNames->endError() => array(
                array('onEndError', 0)
            ),
            $this->eventNames->fileError() => array(
                array('onFileError', 0)
            )
        );
    }

    public function onStart(StartEvent $event)
    {
        $logfile = sprintf('%s/%s', $event->getDir(), $this->filename);
        $this->logger->pushHandler($this->streamHandlerFactory->getInstance($logfile));
    }

    public function onStartError(StartErrorEvent $event)
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