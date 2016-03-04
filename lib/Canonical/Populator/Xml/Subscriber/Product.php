<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Populator\Xml\Subscriber;

use Kompakt\B3d\Canonical\Repository\ProductRepository;
use Kompakt\B3d\Canonical\Unserializer\Xml\Product as Unserializer;
use Kompakt\DirectoryRunner\Event\FileEvent;
use Kompakt\DirectoryRunner\EventNamesInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Product
{
    protected $dispatcher = null;
    protected $eventNames = null;
    protected $unserializer = null;
    protected $repository = null;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        EventNamesInterface $eventNames,
        Unserializer $unserializer,
        ProductRepository $repository
    )
    {
        $this->dispatcher = $dispatcher;
        $this->eventNames = $eventNames;
        $this->unserializer = $unserializer;
        $this->repository = $repository;
    }

    public function activate()
    {
        $this->handleListeners(true);
    }

    public function deactivate()
    {
        $this->handleListeners(false);
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function onFile(FileEvent $event)
    {
        $pathname = $event->getFile()->getPathname();

        if (!preg_match('/\.xml$/i', $pathname))
        {
            return;
        }

        $entity = $this->unserializer->unserialize($pathname);
        $this->repository->add($entity, $pathname);
    }

    protected function handleListeners($add)
    {
        $method = ($add) ? 'addListener' : 'removeListener';

        $this->dispatcher->$method(
            $this->eventNames->file(),
            [$this, 'onFile']
        );
    }
}