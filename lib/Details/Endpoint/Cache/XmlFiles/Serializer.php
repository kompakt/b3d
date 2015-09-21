<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Cache\XmlFiles;

use Kompakt\B3d\Details\Endpoint\Cache\DataMapperInterface;
use Kompakt\B3d\Details\Endpoint\Cache\DomBuilderInterface;
use Kompakt\B3d\Details\Endpoint\Cache\SerializerInterface;
use Kompakt\B3d\Util\File\Writer;

class Serializer implements SerializerInterface
{
    protected $fileWriter = null;
    protected $mapper = null;
    protected $domBuilder = null;
    protected $dirPathname = null;

    public function __construct(
        Writer $fileWriter,
        DataMapperInterface $mapper,
        DomBuilderInterface $domBuilder,
        $dirPathname
    )
    {
        $this->fileWriter = $fileWriter;
        $this->mapper = $mapper;
        $this->domBuilder = $domBuilder;
        $this->dirPathname = $dirPathname;
    }

    public function serialize(array $rawItems)
    {
        foreach ($rawItems as $item)
        {
            $entity = $this->mapper->map($item);
            $dom = $this->domBuilder->build($entity);
            $dom->formatOutput = true;

            $this->fileWriter->write(
                $dom->saveXML(),
                sprintf('%s/%s.xml', $this->dirPathname, uniqid())
            );
        }
    }
}