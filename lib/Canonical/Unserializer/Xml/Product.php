<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Unserializer\Xml;

use Kompakt\B3d\Canonical\Dom\Product\Mapper as DomProductMapper;
use Kompakt\B3d\Canonical\Repository\ProductRepository;
use Kompakt\B3d\Util\Dom\Loader as DomLoader;
use Kompakt\B3d\DropDir\Event\FileEvent;
use Kompakt\B3d\DropDir\EventNamesInterface;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Generic\EventDispatcher\EventSubscriberInterface;

class Product implements EventSubscriberInterface
{
    protected $eventNames = null;
    protected $fileReader = null;
    protected $domLoader = null;
    protected $domMapper = null;
    protected $repository = null;

    public function __construct(
        EventNamesInterface $eventNames,
        Reader $fileReader,
        DomLoader $domLoader,
        DomProductMapper $domMapper,
        ProductRepository $repository
    )
    {
        $this->eventNames = $eventNames;
        $this->fileReader = $fileReader;
        $this->domLoader = $domLoader;
        $this->domMapper = $domMapper;
        $this->repository = $repository;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getSubscriptions()
    {
        return array(
            $this->eventNames->file() => array(
                array('onFile', 0)
            )
        );
    }

    public function onFile(FileEvent $event)
    {
        $pathname = $event->getFile()->getPathname();

        if (!preg_match('/\.xml$/i', $pathname))
        {
            return;
        }

        $fileContents = $this->fileReader->read($pathname);
        $dom = $this->domLoader->load($fileContents);
        $entity = $this->domMapper->map($dom);
        $this->repository->add($entity);
    }
}