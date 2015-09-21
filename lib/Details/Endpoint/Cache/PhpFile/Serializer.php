<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Cache\PhpFile;

use Kompakt\B3d\Details\Endpoint\Cache\SerializerInterface;
use Kompakt\B3d\Util\File\Writer;

class Serializer implements SerializerInterface
{
    protected $fileWriter = null;
    protected $filePathname = null;

    public function __construct(
        Writer $fileWriter,
        $filePathname
    )
    {
        $this->fileWriter = $fileWriter;
        $this->filePathname = $filePathname;
    }

    public function serialize(array $rawItems)
    {
        $this->fileWriter->write(
            serialize($rawItems),
            $this->filePathname
        );
    }
}