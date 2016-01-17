<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Details\Endpoint\Resource\Artist\Endpoint as ArtistEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Endpoint as LabelEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Price\Endpoint as PriceEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Endpoint as ProductEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Endpoint as ProductTrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Endpoint as ReleaseEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Stock\Endpoint as StockEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Endpoint as TrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Cache\PhpFile\Serializer as PhpFileSerializer;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\B3d\Util\Timer\Timer;

$tmpDir = getTmpDir();
$phpSerializerTmpDirPathname = $tmpDir->replaceSubDir('php-cache-data');

// data file
$artistFilePathname = sprintf('%s/artists.data', $phpSerializerTmpDirPathname);
$labelFilePathname = sprintf('%s/labels.data', $phpSerializerTmpDirPathname);
$priceFilePathname = sprintf('%s/prices.data', $phpSerializerTmpDirPathname);
$productFilePathname = sprintf('%s/products.data', $phpSerializerTmpDirPathname);
$productTrackFilePathname = sprintf('%s/product-tracks.data', $phpSerializerTmpDirPathname);
$releaseFilePathname = sprintf('%s/releases.data', $phpSerializerTmpDirPathname);
$stockFilePathname = sprintf('%s/stocks.data', $phpSerializerTmpDirPathname);
$trackFilePathname = sprintf('%s/tracks.data', $phpSerializerTmpDirPathname);

// endpoints
$artistEndpoint = new ArtistEndpoint($client);
$labelEndpoint = new LabelEndpoint($client);
$priceEndpoint = new PriceEndpoint($client);
$productEndpoint = new ProductEndpoint($client);
$productTrackEndpoint = new ProductTrackEndpoint($client);
$releaseEndpoint = new ReleaseEndpoint($client);
$stockEndpoint = new StockEndpoint($client);
$trackEndpoint = new TrackEndpoint($client);

// serializers
$artistPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $artistFilePathname
);

$labelPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $labelFilePathname
);

$pricePhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $priceFilePathname
);

// Memory consumption of ca 70M per 8'000 items
$productPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $productFilePathname
);

// Memory consumption of ca 110M per 43'000 items
$productTrackPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $productTrackFilePathname
);

// Memory consumption of ca 30M per 4'000 items
$releasePhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $releaseFilePathname
);

$stockPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $stockFilePathname
);

// Memory consumption of ca 80M per 19'000 items
$trackPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $trackFilePathname
);

// run
$timer = new Timer();
$timer->start();
$artistPhpFileSerializer->serialize($artistEndpoint->fetchAll());
$labelPhpFileSerializer->serialize($labelEndpoint->fetchAll());
$pricePhpFileSerializer->serialize($priceEndpoint->fetchAll());
$productPhpFileSerializer->serialize($productEndpoint->fetchAll());
$productTrackPhpFileSerializer->serialize($productTrackEndpoint->fetchAll());
$releasePhpFileSerializer->serialize($releaseEndpoint->fetchAll());
$stockPhpFileSerializer->serialize($stockEndpoint->fetchAll());
$trackPhpFileSerializer->serialize($trackEndpoint->fetchAll());
$timer->stop();

echo sprintf("Time: %s Sec\n", $timer->getSeconds(0));
echo sprintf("Memory: %s Mb\n", round(memory_get_usage() / 1024 / 1024, 0));