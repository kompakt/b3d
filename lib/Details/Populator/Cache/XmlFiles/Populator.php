<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Cache\XmlFiles;

use Kompakt\B3d\Details\Populator\MapperInterface;
use Kompakt\B3d\Details\Populator\RepositoryInterface;
use Kompakt\B3d\Util\Dom\Loader as DomLoader;
use Kompakt\B3d\DropDir\Event\FileEvent;
use Kompakt\B3d\DropDir\EventNamesInterface;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Generic\EventDispatcher\EventSubscriberInterface;

class Populator implements EventSubscriberInterface
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
        MapperInterface $domMapper,
        RepositoryInterface $repository
    )
    {
        $this->eventNames = $eventNames;
        $this->fileReader = $fileReader;
        $this->domLoader = $domLoader;
        $this->domMapper = $domMapper;
        $this->repository = $repository;
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