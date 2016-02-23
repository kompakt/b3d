<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Unserializer\Xml;

use Kompakt\B3d\Canonical\Dom\Product\Mapper;
use Kompakt\B3d\Util\Dom\Loader;
use Kompakt\B3d\Util\File\Reader;

class Product
{
    protected $fileReader = null;
    protected $domLoader = null;
    protected $domMapper = null;

    public function __construct(
        Reader $fileReader,
        Loader $domLoader,
        Mapper $domMapper
    )
    {
        $this->fileReader = $fileReader;
        $this->domLoader = $domLoader;
        $this->domMapper = $domMapper;
    }

    public function unserialize($pathname)
    {
        $fileContents = $this->fileReader->read($pathname);
        $dom = $this->domLoader->load($fileContents);
        return $this->domMapper->map($dom);
    }
}