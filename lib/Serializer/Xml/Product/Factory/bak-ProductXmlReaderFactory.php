<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Product\Factory;

use Kompakt\B3d\Serializer\Xml\Product\ProductXmlParser;
use Kompakt\B3d\Serializer\Xml\Product\ProductXmlReader;

class ProductXmlReaderFactory
{
    protected $xmlParser = null;

    public function __construct(ProductXmlParser $xmlParser)
    {
        $this->xmlParser = $xmlParser;
    }

    public function getInstance($file)
    {
        return new ProductXmlReader($this->xmlParser, $file);
    }
}