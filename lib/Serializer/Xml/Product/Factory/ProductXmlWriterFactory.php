<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Product\Factory;

use Kompakt\B3d\Entity\Product;
use Kompakt\B3d\Serializer\Xml\Product\ProductXmlBuilder;
use Kompakt\B3d\Serializer\Xml\Product\ProductXmlWriter;

class ProductXmlWriterFactory
{
    protected $xmlBuilder = null;
    protected $product = null;

    public function __construct(ProductXmlBuilder $xmlBuilder)
    {
        $this->xmlBuilder = $xmlBuilder;
    }

    public function getInstance(Product $product)
    {
        return new ProductXmlWriter($this->xmlBuilder, $product);
    }
}