<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Product;
use Kompakt\B3d\Fetcher\ProductFetcher;
use Kompakt\B3d\Serializer\Xml\Product\Factory\ProductXmlWriterFactory;
use Kompakt\B3d\Serializer\Xml\Product\ProductXmlBuilder;

$tmpDir = getTmpDir();
$tmpDirPathname = $tmpDir->replaceSubDir('serializer/products');

// compose
$productPrototype = new Product();
$productXmlWriterFactory = new ProductXmlWriterFactory(new ProductXmlBuilder());
$fetcher = new ProductFetcher($client, $productPrototype);

// run
$products = $fetcher->fetchAll();
echo sprintf("%s\n", count($products));

foreach ($products as $product)
{
    $writer = $productXmlWriterFactory->getInstance($product);
    $writer->write(sprintf('%s/%s.xml', $tmpDirPathname, uniqid()));
}