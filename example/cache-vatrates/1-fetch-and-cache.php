<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\VatRate\Endpoint as VatRateEndpoint;
use Kompakt\B3d\Details\Endpoint\Cache\PhpFile\Serializer as PhpFileSerializer;
use Kompakt\B3d\Util\File\Writer;
use Symfony\Component\Stopwatch\Stopwatch;

$tmpDir = getTmpDir();
$phpSerializerTmpDirPathname = $tmpDir->replaceSubDir('php-cache-vatrate-data');

// http client
$client = new Client();

// data file
$vatrateFilePathname = sprintf('%s/vatrates.data', $phpSerializerTmpDirPathname);

// endpoint
$vatrateEndpoint = new VatRateEndpoint(
    $client,
    EXAMPLE_KOMPAKT_B3D_BASE_URL,
    EXAMPLE_KOMPAKT_B3D_API_KEY
);

// serializer
$vatratePhpFileSerializer = new PhpFileSerializer(
    new Writer(),
    $vatrateFilePathname
);

// run
$stopwatch = new Stopwatch();
$stopwatch->start('b3d', 'b3d');
$vatratePhpFileSerializer->serialize($vatrateEndpoint->fetchAll());
$event = $stopwatch->stop('b3d');

echo sprintf("%s\n", $event);