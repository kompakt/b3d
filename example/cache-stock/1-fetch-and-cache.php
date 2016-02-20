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
use Kompakt\B3d\Util\Timer\Timer;

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
$timer = new Timer();
$timer->start();
$stockPhpFileSerializer->serialize($stockEndpoint->fetch());
$timer->stop();

echo sprintf("Time: %s Sec\n", $timer->getSeconds(0));
echo sprintf("Memory: %s Mb\n", round(memory_get_usage() / 1024 / 1024, 0));