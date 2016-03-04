<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

use Kompakt\B3d\Canonical\Dom\Product\Mapper as DomProductMapper;
use Kompakt\B3d\Canonical\Entity\Price;
use Kompakt\B3d\Canonical\Entity\Product;
use Kompakt\B3d\Canonical\Entity\Track;
use Kompakt\B3d\Canonical\Populator\Xml\Subscriber\Product as Populator;
use Kompakt\B3d\Canonical\Repository\ProductRepository;
use Kompakt\B3d\Canonical\Unserializer\Xml\Product as Unserializer;
use Kompakt\B3d\Util\Dom\Loader as DomLoader;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\DirectoryRunner\Runner;
use Kompakt\DirectoryRunner\EventNames;
use Kompakt\DirectoryRunner\Subscriber\Debugger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Stopwatch\Stopwatch;

require sprintf('%s/bootstrap.php', dirname(__DIR__));

$canonicalProductDirPathname = sprintf('%s/php-cache-product-xml', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

if (!is_dir($canonicalProductDirPathname))
{
    die(sprintf("%s\n", 'Please fetch and serialize first'));
}

$dispatcher = new EventDispatcher();
$eventNames = new EventNames();
$fileReader = new Reader();
$domLoader = new DomLoader();

$runner = new Runner(
    $dispatcher,
    $eventNames,
    $canonicalProductDirPathname
);

$price = new Price();
$product = new Product();
$track = new Track();
$domMapper = new DomProductMapper($product, $track, $price);
$repository = new ProductRepository();

$debugger = new Debugger(
    $dispatcher,
    $eventNames
);

$unserializer = new Unserializer(
    $fileReader,
    $domLoader,
    $domMapper
);

$populator = new Populator(
    $dispatcher,
    $eventNames,
    $unserializer,
    $repository
);

// run
$stopwatch = new Stopwatch();
$stopwatch->start('b3d', 'b3d');
#$debugger->activate();
$populator->activate();
$runner->run();
$event = $stopwatch->stop('b3d');

foreach ($repository->getAll() as $product)
{
    echo sprintf("%s\n", $product->getReleaseTitle());

    foreach ($product->getTracks() as $track)
    {
        #echo sprintf(">> %s\n", $track->getTitle());
    }
}

echo sprintf("%s\n", $event);
echo sprintf("Products: %s\n", count($repository->getAll()));