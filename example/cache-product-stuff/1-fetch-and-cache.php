<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Endpoint as ArtistEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Endpoint as LabelEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Price\Endpoint as PriceEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Endpoint as ProductEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Endpoint as ProductTrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Endpoint as ReleaseEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Endpoint as TrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Cache\PhpFile\Serializer as PhpFileSerializer;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\B3d\Util\Timer\Timer;

$tmpDir = getTmpDir();
$phpSerializerTmpDirPathname = $tmpDir->replaceSubDir('php-cache-product-data');

// data file
$artistFilePathname = sprintf('%s/artists.data', $phpSerializerTmpDirPathname);
$labelFilePathname = sprintf('%s/labels.data', $phpSerializerTmpDirPathname);
$priceFilePathname = sprintf('%s/prices.data', $phpSerializerTmpDirPathname);
$productFilePathname = sprintf('%s/products.data', $phpSerializerTmpDirPathname);
$productTrackFilePathname = sprintf('%s/product-tracks.data', $phpSerializerTmpDirPathname);
$releaseFilePathname = sprintf('%s/releases.data', $phpSerializerTmpDirPathname);
$trackFilePathname = sprintf('%s/tracks.data', $phpSerializerTmpDirPathname);

// http client
$client = new Client();

// endpoints
$artistEndpoint = new ArtistEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

$labelEndpoint = new LabelEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

$priceEndpoint = new PriceEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

$productEndpoint = new ProductEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

$productTrackEndpoint = new ProductTrackEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

$releaseEndpoint = new ReleaseEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

$trackEndpoint = new TrackEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

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

$productPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $productFilePathname
);

$productTrackPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $productTrackFilePathname
);

$releasePhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $releaseFilePathname
);

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
$trackPhpFileSerializer->serialize($trackEndpoint->fetchAll());
$timer->stop();

echo sprintf("Time: %s Sec\n", $timer->getSeconds(0));
echo sprintf("Memory: %s Mb\n", round(memory_get_usage() / 1024 / 1024, 0));