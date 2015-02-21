<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Product;
use Kompakt\B3d\Unserializer\Xml\Product\Factory\ProductXmlReaderFactory;
use Kompakt\B3d\Unserializer\Xml\Product\ProductXmlParser;

$tmpDirPathname = sprintf('%s/_files/products', __DIR__);

// compose
$productPrototype = new Product();
$productXmlParser = new ProductXmlParser($productPrototype);
$productXmlReaderFactory = new ProductXmlReaderFactory($productXmlParser);

// run
foreach (new \DirectoryIterator($tmpDirPathname) as $fileInfo)
{
    if ($fileInfo->isDot())
    {
        continue;
    }

    if ($fileInfo->isDir())
    {
        continue;
    }

    $reader = $productXmlReaderFactory->getInstance($fileInfo->getPathname());
    $product = $reader->read();
    echo sprintf("%s\n", $product->getCatalogNumber());
}