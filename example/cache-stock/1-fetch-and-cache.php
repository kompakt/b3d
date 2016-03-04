<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Stock\Endpoint as StockEndpoint;
use Kompakt\B3d\Details\Endpoint\Cache\PhpFile\Serializer as PhpFileSerializer;
use Kompakt\B3d\Util\File\Writer;
use Symfony\Component\Stopwatch\Stopwatch;

$tmpDir = getTmpDir();
$phpSerializerTmpDirPathname = $tmpDir->replaceSubDir('php-cache-stock-data');

// http client
$client = new Client();

// data file
$stockFilePathname = sprintf('%s/stocks.data', $phpSerializerTmpDirPathname);

// endpoint
$stockEndpoint = new StockEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

// serializer
$stockPhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $stockFilePathname
);

// run
$stopwatch = new Stopwatch();
$stopwatch->start('b3d', 'b3d');
$stockPhpFileSerializer->serialize($stockEndpoint->fetch(['uuid-1', 'uuid-2']));
$event = $stopwatch->stop('b3d');

echo sprintf("%s\n", $event);