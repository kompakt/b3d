<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Serializer\Xml;

use Kompakt\B3d\Canonical\Dom\Product\Builder as DomBuilder;
use Kompakt\B3d\Canonical\Entity\Product as ProductEntity;
use Kompakt\B3d\Util\File\Writer;

class Product
{
    protected $domBuilder = null;
    protected $fileWriter = null;
    protected $dirPathname = null;

    public function __construct(
        DomBuilder $domBuilder,
        Writer $fileWriter,
        $dirPathname
    )
    {
        $this->domBuilder = $domBuilder;
        $this->fileWriter = $fileWriter;
        $this->dirPathname = $dirPathname;
    }

    public function serialize(ProductEntity $product)
    {
        $dom = $this->domBuilder->build($product);
        $dom->formatOutput = true;

        $this->fileWriter->write(
            $dom->saveXML(),
            sprintf('%s/%s.xml', $this->dirPathname, $product->getUuid())
        );
    }
}