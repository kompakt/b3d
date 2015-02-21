<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Product;

use Kompakt\B3d\Serializer\Xml\Product\Exception\InvalidArgumentException;
use Kompakt\B3d\Serializer\Xml\Product\ProductXmlParser;

class ProductXmlReader
{
    protected $xmlParser = null;
    protected $file = null;

    public function __construct(ProductXmlParser $xmlParser, $file)
    {
        $info = new \SplFileInfo($file);

        if (!$info->isFile())
        {
            throw new InvalidArgumentException(sprintf('Xml file not found'));
        }

        if (!$info->isReadable())
        {
            throw new InvalidArgumentException(sprintf('Xml file not readable'));
        }

        $this->xmlParser = $xmlParser;
        $this->file = $file;
    }

    public function read()
    {
        $handle = fopen($this->file, 'r');
        $xml = fread($handle, filesize($this->file));
        fclose($handle);
        return $this->xmlParser->parse($xml);
    }
}