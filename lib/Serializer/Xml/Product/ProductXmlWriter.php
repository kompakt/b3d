<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Product;

use Kompakt\B3d\Entity\Product;
use Kompakt\B3d\Serializer\Xml\Product\Exception\InvalidArgumentException;
use Kompakt\B3d\Serializer\Xml\Product\ProductXmlBuilder;

class ProductXmlWriter
{
    protected $xmlBuilder = null;
    protected $product = null;

    public function __construct(
        ProductXmlBuilder $xmlBuilder,
        Product $product
    )
    {
        $this->xmlBuilder = $xmlBuilder;
        $this->product = $product;
    }

    public function write($file)
    {
        $info = new \SplFileInfo(dirname($file));

        if (!$info->isDir())
        {
            throw new InvalidArgumentException(sprintf('Xml dir not found'));
        }

        if (!$info->isWritable())
        {
            throw new InvalidArgumentException(sprintf('Xml dir not writable'));
        }

        $dom = $this->xmlBuilder->build($this->product);
        $dom->formatOutput = true;
        $fileInfo = new \SplFileInfo($file);

        if ($fileInfo->isFile())
        {
            unlink($file);
        }

        $h = fopen($file, 'w');
        fwrite($h, $dom->saveXML());
        fclose($h);
    }
}