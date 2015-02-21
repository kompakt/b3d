<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Unserializer\Xml\Release;

use Kompakt\B3d\Repository\ReleaseRepository;
use Kompakt\B3d\Unserializer\Xml\Release\Exception\InvalidArgumentException;
use Kompakt\B3d\Unserializer\Xml\Release\Factory\ReleaseXmlReaderFactory;

class ReleaseXmlLoader
{
    protected $repository = null;
    protected $xmlReaderFactory = null;

    public function __construct(
        ReleaseRepository $repository,
        ReleaseXmlReaderFactory $xmlReaderFactory
    )
    {
        $this->repository = $repository;
        $this->xmlReaderFactory = $xmlReaderFactory;
    }

    public function load($dir)
    {
        $info = new \SplFileInfo($dir);

        if (!$info->isDir())
        {
            throw new InvalidArgumentException(sprintf('Xml dir not found'));
        }

        if (!$info->isReadable())
        {
            throw new InvalidArgumentException(sprintf('Xml dir not readable'));
        }

        foreach (new \DirectoryIterator($dir) as $fileInfo)
        {
            if ($fileInfo->isDot())
            {
                continue;
            }

            if ($fileInfo->isDir())
            {
                continue;
            }

            $reader = $this->xmlReaderFactory->getInstance($fileInfo->getPathname());
            $this->repository->add($reader->read());
        }
    }
}